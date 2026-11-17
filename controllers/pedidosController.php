<?php
    require_once __DIR__ . '/../models/pedidos.php';
    require_once __DIR__ . '/../dao/pedidosDAO.php';
    require_once __DIR__ . '/../models/pedido_detalle.php';
    require_once __DIR__ . '/../dao/pedido_detalleDAO.php';
    require_once __DIR__ . '/../models/pedido_detalle_ingrediente.php';
    require_once __DIR__ . '/../dao/pedido_detalle_ingredienteDAO.php';
    require_once __DIR__ . '/../models/productos.php';
    require_once __DIR__ . '/../dao/productosDAO.php';
    require_once __DIR__ . '/../models/ingredientes.php';
    require_once __DIR__ . '/../dao/ingredientesDAO.php';
    require_once __DIR__ . '/../models/ofertas.php';
    require_once __DIR__ . '/../dao/ofertasDAO.php';

    class PedidosController {
        // La ruta principal del controlador lleva a la preparación del pedido.
        public function index() {
            $this->create();
        }

        // Prepara el resumen del carrito y los importes de la pantalla de pago.
        public function create() {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            // Solo un usuario conectado puede iniciar un pedido.
            if (empty($_SESSION['usuario'])) {
                header('Location: index.php?controller=usuario&action=login');
                exit;
            }

            if (empty($_SESSION['carrito'])) {
                header('Location: index.php?controller=carrito');
                exit;
            }

            $productosCarrito = [];
            $subtotalCentimos = 0;

            // Convierte las líneas de sesión a los datos que necesita la vista.
            foreach ($_SESSION['carrito'] as $clave => $linea) {
                $producto = productosDAO::selectByID($linea['producto_id']);

                if (!$producto) {
                    continue;
                }

                $cantidad = (int) $linea['cantidad'];
                // Se calculan los importes en céntimos para evitar errores de redondeo.
                $precioCentimos = (int) round((float) $linea['precio_unitario'] * 100);
                $totalLineaCentimos = $precioCentimos * $cantidad;

                $ingredientesLinea = [];

                // Recupera los nombres de las personalizaciones válidas del producto.
                foreach (($linea['ingredientes'] ?? []) as $ingredienteID => $accion) {
                    $ingrediente = ingredientesDAO::selectByID((int) $ingredienteID);

                    if (!$ingrediente || !in_array($accion, ['anadir', 'quitar'], true)) {
                        continue;
                    }

                    $ingredientesLinea[] = [
                        'nombre' => $ingrediente->getNombre(),
                        'accion' => $accion
                    ];
                }

                $productosCarrito[] = [
                    'nombre' => $producto->getNombre(),
                    'cantidad' => $cantidad,
                    'precio_unitario' => $precioCentimos / 100,
                    'subtotal' => $totalLineaCentimos / 100,
                    'ingredientes' => $ingredientesLinea
                ];

                $subtotalCentimos += $totalLineaCentimos;
            }

            if (empty($productosCarrito)) {
                header('Location: index.php?controller=carrito');
                exit;
            }

            $subtotal = $subtotalCentimos / 100;
            $descuento = 0;

            // Vuelve a consultar el cupón para calcular el importe que se mostrará.
            $codigoCupon = $_SESSION['cupon_codigo'] ?? null;
            if ($codigoCupon !== null) {
                $oferta = ofertasDAO::selectByCodigo($codigoCupon);
                if ($oferta !== null) {
                    $descuento = $subtotal * ((float) $oferta->getValor() / 100);
                }
            }

            $total = max(0, $subtotal - $descuento);

            $titulo = 'Finalizar pedido';
            $view = __DIR__ . '/../views/pagar.php';
            $css = 'pagar.css';
            $js = 'pagar.js';

            require __DIR__ . '/../views/main3.php';
        }

        // Valida la confirmación y guarda el pedido, sus productos y sus ingredientes.
        public function store() {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            // Exige el envío del formulario y la aceptación de los términos.
            if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST['terminos'])) {
                header('Location: index.php?controller=pedidos&action=create');
                exit;
            }

            if (empty($_SESSION['usuario']) || empty($_SESSION['carrito'])) {
                header('Location: index.php?controller=usuario&action=login');
                exit;
            }

            $usuarioID = (int) $_SESSION['usuario']->id;
            $subtotalCentimos = 0;
            $subtotal = 0;
            $descuento = 0;
            $total = 0;

            $pedido = new pedidos(
                null,
                $usuarioID,
                'pendiente',
                date('Y-m-d H:i:s'),
                $subtotal,
                $descuento,
                $total,
                'pendiente',
                'pendiente'
            );

            $pedidoID = pedidosDAO::insert($pedido);

            if (!$pedidoID) {
                showError(500, 'No se ha podido crear el pedido.');
                return;
            }

            $pedido->setId($pedidoID);

            // Guarda cada producto como un detalle asociado al nuevo pedido.
            foreach ($_SESSION['carrito'] as $linea) {
                $productoID = (int) $linea['producto_id'];
                $cantidad = (int) $linea['cantidad'];
                $precioUnitario = (float) $linea['precio_unitario'];

                if ($cantidad < 1 || $precioUnitario < 0) {
                    continue;
                }

                $producto = productosDAO::selectByID($productoID);

                if (!$producto) {
                    continue;
                }

                $subtotalDetalle = $precioUnitario * $cantidad;
                $subtotalCentimos += (int) round($subtotalDetalle * 100);

                $detalle = new pedido_detalle(
                    null,
                    $pedidoID,
                    $productoID,
                    $producto->getNombre(),
                    $precioUnitario,
                    $cantidad,
                    $subtotalDetalle
                );

                $detalleID = pedido_detalleDAO::insert($detalle);

                if (!$detalleID) {
                    showError(500, 'No se ha podido guardar un producto del pedido.');
                    return;
                }

                // Guarda aparte las personalizaciones elegidas para esta línea.
                foreach (($linea['ingredientes'] ?? []) as $ingredienteID => $accion) {
                    if (!in_array($accion, ['anadir', 'quitar'], true)) {
                        continue;
                    }

                    $ingrediente = ingredientesDAO::selectByID((int) $ingredienteID);

                    if (!$ingrediente) {
                        continue;
                    }

                    $detalleIngrediente = new pedido_detalle_ingrediente(
                        null,
                        $detalleID,
                        (int) $ingredienteID,
                        $ingrediente->getNombre(),
                        (float) $ingrediente->getPrecioExtra(),
                        $accion
                    );

                    $ingredienteIDInsertado = pedido_detalle_ingredienteDAO::insert($detalleIngrediente);

                    if (!$ingredienteIDInsertado) {
                        showError(500, 'No se ha podido guardar un ingrediente del pedido.');
                        return;
                    }
                }
            }

            if ($subtotalCentimos === 0) {
                showError(400, 'El pedido no contiene productos válidos.');
                return;
            }

            $subtotal = $subtotalCentimos / 100;
            $descuento = 0;

            // Calcula de nuevo el descuento al confirmar para guardar el total final.
            $codigoCupon = $_SESSION['cupon_codigo'] ?? null;
            if ($codigoCupon !== null) {
                $oferta = ofertasDAO::selectByCodigo($codigoCupon);
                if ($oferta !== null) {
                    $descuento = $subtotal * ((float) $oferta->getValor() / 100);
                }
            }

            $total = max(0, $subtotal - $descuento);

            $pedido->setSubtotal($subtotal);
            $pedido->setDescuento($descuento);
            $pedido->setTotal($total);

            if (!pedidosDAO::update($pedido)) {
                showError(500, 'No se ha podido actualizar el importe del pedido.');
                return;
            }

            // Vacía el carrito y deja en sesión lo necesario para mostrar la confirmación.
            unset($_SESSION['carrito']);

            $_SESSION['compra_correcta'] = true;
            $_SESSION['pedido_confirmado_id'] = $pedidoID;

            header('Location: index.php?controller=pedidos&action=show');
            exit;
        }

        // Muestra la confirmación una sola vez usando los datos guardados en la sesión.
        public function show() {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            if (empty($_SESSION['usuario'])) {
                header('Location: index.php?controller=usuario&action=login');
                exit;
            }

            $compraCorrecta = !empty($_SESSION['compra_correcta']);
            $pedidoID = (int) ($_SESSION['pedido_confirmado_id'] ?? 0);
            unset($_SESSION['compra_correcta'], $_SESSION['pedido_confirmado_id']);

            if (!$compraCorrecta || $pedidoID < 1) {
                header('Location: index.php?controller=usuario&action=show');
                exit;
            }

            $titulo = 'Pedido confirmado';
            $view = __DIR__ . '/../views/pedidoConfirmado.php';
            $js = 'pagar.js';
            require __DIR__ . '/../views/main3.php';
        }
    }
?>
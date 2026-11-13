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

    class PedidosController {
        public function index() {
            $this->create();
        }

        public function create() {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

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

            foreach ($_SESSION['carrito'] as $clave => $linea) {
                $producto = productosDAO::selectByID($linea['producto_id']);

                if (!$producto) {
                    continue;
                }

                $cantidad = (int) $linea['cantidad'];
                $precioCentimos = (int) round((float) $linea['precio_unitario'] * 100);
                $totalLineaCentimos = $precioCentimos * $cantidad;

                $ingredientesLinea = [];

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
            $total = $subtotal;

            $titulo = 'Finalizar pedido';
            $view = __DIR__ . '/../views/pagar.php';
            $css = 'pagar.css';
            $js = 'pagar.js';

            require __DIR__ . '/../views/main3.php';
        }

        public function store() {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

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
            $descuento = 0;

            $pedido = new pedidos(
                null,
                $usuarioID,
                'pendiente',
                date('Y-m-d H:i:s'),
                0,
                0,
                0,
                'pendiente',
                'pendiente'
            );

            $pedidoID = pedidosDAO::insert($pedido);

            if (!$pedidoID) {
                showError(500, 'No se ha podido crear el pedido.');
                return;
            }

            $pedido->setId($pedidoID);

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
            $total = $subtotal - $descuento;

            $pedido->setSubtotal($subtotal);
            $pedido->setDescuento($descuento);
            $pedido->setTotal($total);

            if (!pedidosDAO::update($pedido)) {
                showError(500, 'No se ha podido actualizar el importe del pedido.');
                return;
            }

            unset($_SESSION['carrito']);

            $_SESSION['compra_correcta'] = true;
            $_SESSION['pedido_confirmado_id'] = $pedidoID;

            header('Location: index.php?controller=pedidos&action=show');
            exit;
        }

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
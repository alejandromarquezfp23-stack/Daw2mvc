<?php
    require_once __DIR__ . '/../models/productos.php';
    require_once __DIR__ . '/../dao/productosDAO.php';
    require_once __DIR__ . '/../models/ofertas.php';
    require_once __DIR__ . '/../dao/ofertasDAO.php';

    class CarritoController {
        // Prepara los productos, el cupón y los importes para mostrar el carrito.
        public function index() {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            if (!isset($_SESSION['carrito'])) {
                $_SESSION['carrito'] = [];
            }

            $carritoSesion = $_SESSION['carrito'];
            $productosCarrito = [];

            // Descarta líneas incompletas o productos que ya no existen.
            foreach ($carritoSesion as $claveCarrito => $linea) {
                $idProducto = $linea['producto_id'] ?? null;
                $cantidad = $linea['cantidad'] ?? 0;

                $producto = productosDAO::selectByID($idProducto);

                if ($producto && is_numeric($cantidad) && $cantidad > 0) {
                    $productosCarrito[] = [
                        'clave' => $claveCarrito,
                        'producto' => $producto,
                        'cantidad' => (int) $cantidad,
                        'precio_unitario' => (float) $linea['precio_unitario']
                    ];
                } else {
                    unset($_SESSION['carrito'][$claveCarrito]);
                }
            }

            $subtotalCarrito = 0;
            // Suma el precio de cada línea según su cantidad.
            foreach ($productosCarrito as $item) {
                $subtotalCarrito += $item['precio_unitario'] * $item['cantidad'];
            }

            // Aplica el porcentaje del cupón válido al subtotal.
            $descuento = 0;
            $codigoCupon = $_SESSION['cupon_codigo'] ?? null;

            if ($codigoCupon !== null) {
                $oferta = ofertasDAO::selectByCodigo($codigoCupon);

                if ($oferta !== null) {
                    $descuento = $subtotalCarrito * ((float) $oferta->getValor() / 100);
                }
            }

            $totalFinal = max(0, $subtotalCarrito - $descuento);
            // El mensaje se muestra una sola vez y después se elimina de la sesión.
            $mensajeCupon = $_SESSION['mensaje_cupon'] ?? null;
            unset($_SESSION['mensaje_cupon']);

            $titulo = 'Carrito de Appletito';
            $view = __DIR__ . '/../views/carrito.php';
            $css = 'carrito.css';

            require __DIR__ . '/../views/main3.php';
        }

        // Actualiza la cantidad de una línea del carrito y vuelve a la página.
        public function update() {
            // Esta acción solo acepta envíos de formularios.
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                http_response_code(405);
                exit;
            }

            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            $this->actualizarCantidad();

            header('Location: ' . url . 'index.php?controller=carrito');
            exit;
        }

        // Elimina del carrito la línea indicada por su clave.
        public function destroy() {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                http_response_code(405);
                exit;
            }

            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            $claveCarrito = $_POST['clave_carrito'] ?? null;

            if ($claveCarrito !== null && isset($_SESSION['carrito'][$claveCarrito])) {
                unset($_SESSION['carrito'][$claveCarrito]);
            }

            header('Location: ' . url . 'index.php?controller=carrito');
            exit;
        }

        // Suma o resta una unidad; elimina la línea si la cantidad llega a cero.
        private function actualizarCantidad() {
            $claveCarrito = $_POST['clave_carrito'] ?? null;

            if ($claveCarrito === null || !isset($_SESSION['carrito'][$claveCarrito])) {
                return;
            }

            if (isset($_POST['sumar'])) {
                $_SESSION['carrito'][$claveCarrito]['cantidad']++;
            }

            if (isset($_POST['restar'])) {
                $_SESSION['carrito'][$claveCarrito]['cantidad']--;

                if ($_SESSION['carrito'][$claveCarrito]['cantidad'] <= 0) {
                    unset($_SESSION['carrito'][$claveCarrito]);
                }
            }
        }

        // Comprueba el cupón enviado y guarda el resultado para mostrarlo al usuario.
        public function cupon() {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                http_response_code(405);
                exit;
            }

            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            $codigoCupon = trim($_POST['cupon'] ?? '');
            // Evita consultar la base de datos si el campo llegó vacío.
            $oferta = $codigoCupon !== '' ? ofertasDAO::selectByCodigo($codigoCupon) : null;

            if ($oferta !== null) {
                $_SESSION['cupon_codigo'] = $codigoCupon;
                $_SESSION['mensaje_cupon'] = 'Cupón aplicado correctamente.';
            } else {
                unset($_SESSION['cupon_codigo']);
                $_SESSION['mensaje_cupon'] = 'El código introducido no es válido.';
            }

            header('Location: ' . url . 'index.php?controller=carrito');
            exit;
        }
    }
?>
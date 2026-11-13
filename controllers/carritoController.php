<?php
    require_once __DIR__ . '/../models/productos.php';
    require_once __DIR__ . '/../dao/productosDAO.php';

    class CarritoController {
        public function index() {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            if (!isset($_SESSION['carrito'])) {
                $_SESSION['carrito'] = [];
            }

            $carritoSesion = $_SESSION['carrito'];
            $productosCarrito = [];

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

            $titulo = 'Carrito de Appletito';
            $view = __DIR__ . '/../views/carrito.php';
            $css = 'carrito.css';

            require __DIR__ . '/../views/main3.php';
        }

        public function update() {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                http_response_code(405);
                exit;
            }

            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            $this->actualizarCantidad();

            header('Location: /Daw2mvc/index.php?controller=carrito');
            exit;
        }

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

            header('Location: /Daw2mvc/index.php?controller=carrito');
            exit;
        }

        public function checkout() {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            $titulo = 'Pagar';
            $view = __DIR__ . '/../views/pagar.php';
            $css = 'pagar.css';

            require __DIR__ . '/../views/main3.php';
        }

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
    }
?>
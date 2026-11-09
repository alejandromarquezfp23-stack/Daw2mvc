<?php
require_once __DIR__ . '/../models/productos.php';
require_once __DIR__ . '/../dao/productosDAO.php';

class CarritoController {
    public function index() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $claveCarrito = $_POST['clave_carrito'] ?? null;

            if ($claveCarrito !== null && isset($_SESSION['carrito'][$claveCarrito])) {

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

            header('Location: /Daw2mvc/index.php?controller=carrito');
            exit;
        }

        $carritoSesion = $_SESSION['carrito'] ?? [];
        $productosCarrito = [];

        foreach ($carritoSesion as $claveCarrito => $linea) {

            if (is_array($linea)) {
                $idProducto = $linea['producto_id'] ?? null;
                $cantidad = $linea['cantidad'] ?? 0;
                $precioUnitario = $linea['precio_unitario'] ?? null;
            } else {
                $idProducto = $claveCarrito;
                $cantidad = $linea;
                $precioUnitario = null;
            }

            $producto = productosDAO::selectByID($idProducto);

            if ($producto && is_numeric($cantidad) && $cantidad > 0) {
                $productosCarrito[] = [
                    'clave' => $claveCarrito,
                    'producto' => $producto,
                    'cantidad' => (int) $cantidad,
                    'precio_unitario' => is_numeric($precioUnitario)
                        ? (float) $precioUnitario
                        : (float) $producto->getPrecio()
                ];
            }
        }

        $view = __DIR__ . '/../views/carrito.php';
        $css = 'carrito.css';
        require_once __DIR__ . '/../views/main3.php';
    }


    public function eliminar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $claveCarrito = $_POST['clave_carrito'] ?? null;
            $productoId = $_POST['producto_id'] ?? null;

            if ($claveCarrito !== null && isset($_SESSION['carrito'][$claveCarrito])) {
                unset($_SESSION['carrito'][$claveCarrito]);
            } elseif ($productoId !== null && isset($_SESSION['carrito'][$productoId])) {
                unset($_SESSION['carrito'][$productoId]);
            }
        }

        header('Location: /Daw2mvc/index.php?controller=carrito');
        exit;
    }
}
?>
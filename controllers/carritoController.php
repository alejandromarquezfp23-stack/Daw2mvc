<?php
require_once __DIR__ . '/../models/productos.php';
require_once __DIR__ . '/../dao/productosDAO.php';

class CarritoController {
    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $carritoSesion = $_SESSION['carrito'] ?? [];
        $productosCarrito = [];

        foreach ($carritoSesion as $idProducto => $cantidad) {
            $producto = productosDAO::selectByID($idProducto);

            if ($producto) {
                $productosCarrito[] = [
                    'producto' => $producto,
                    'cantidad' => $cantidad
                ];
            }
        }

        $view = __DIR__ . '/../views/carrito.php';
        $css = 'carrito.css';
        require_once __DIR__ . '/../views/main3.php';
    }

    public function eliminar() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productoId = $_POST['producto_id'] ?? null;

            if ($productoId !== null && isset($_SESSION['carrito'][$productoId])) {
                unset($_SESSION['carrito'][$productoId]);
            }
        }

        header('Location: /Daw2mvc/index.php?controller=carrito');
        exit;
    }
}
?>
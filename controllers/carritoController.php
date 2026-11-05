<?php
require_once __DIR__ . '/../models/productos.php';
require_once __DIR__ . '/../dao/productosDAO.php';
require_once __DIR__ . '/../config/dataBase.php'; 

class CarritoController {
    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $conexion = DataBase::connect();
        $productosDAO = new productosDAO($conexion); 

        $carritoSesion = $_SESSION['carrito'] ?? [];
        $productosCarrito = [];

        foreach ($carritoSesion as $idProducto => $cantidad) {
            $producto = $productosDAO->selectById($idProducto); 

            if ($producto) {
                $productosCarrito[] = [
                    'producto' => $producto,
                    'cantidad' => $cantidad
                ];
            }
        }

        require_once __DIR__ . '/../views/carrito.php';
    }
}
?>
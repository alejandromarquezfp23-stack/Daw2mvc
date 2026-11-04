<?php
require_once __DIR__ . '/../config/DataBase.php';
require_once __DIR__ . '/../dao/productosDAO.php';
require_once __DIR__ . '/../dao/CategoriasDAO.php';

class homeController {

    public function index() {
        $conexion = DataBase::connect();
        $productosDAO = new productosDAO($conexion);
        $categoriasDAO = new CategoriasDAO($conexion);

        $productos = $productosDAO->selectAll();
        $categorias = $categoriasDAO->selectAll();
        $productoMasPedido = $productosDAO->selectMasPedido();
        $productosRandom = $productosDAO->selectRandom();

        require_once __DIR__ . '/../views/home.php';
    }
}
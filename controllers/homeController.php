<?php
require_once __DIR__ . '/../config/DataBase.php';
require_once __DIR__ . '/../dao/productosDAO.php';
require_once __DIR__ . '/../dao/CategoriasDAO.php';

class homeController {

    public function index() {
        $conexion = DataBase::connect();

        // 1. Instanciamos los DAOs que necesitemos
        $productosDAO = new productosDAO($conexion);
        $categoriasDAO = new CategoriasDAO($conexion);

        // 2. Traemos datos para la portada (ejemplo: productos y categorías)
        $productos = $productosDAO->selectAll();
        $categorias = $categoriasDAO->selectAll();

        // 3. Cargamos la vista de la portada
        require_once __DIR__ . '/../views/home.php';
    }
}
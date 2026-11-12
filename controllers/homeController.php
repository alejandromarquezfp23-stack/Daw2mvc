<?php
require_once __DIR__ . '/../dao/productosDAO.php';
require_once __DIR__ . '/../dao/CategoriasDAO.php';

class homeController {

    public function index() {
        $productos = productosDAO::selectAll();
        $categorias = categoriasDAO::selectAll();
        $productoMasPedido = productosDAO::selectMasPedido();
        $productosRandom = productosDAO::selectRandom();

        $titulo = 'Appletito';
        $view = __DIR__ . '/../views/home.php';
        $css = 'home.css';

        require_once __DIR__ . '/../views/main.php';
    }
}
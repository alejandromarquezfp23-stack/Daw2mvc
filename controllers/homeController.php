<?php
    require_once __DIR__ . '/../dao/productosDAO.php';
    require_once __DIR__ . '/../dao/categoriasDAO.php';

    class HomeController {
        // Carga los datos destacados y muestra la página de inicio.
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
?>
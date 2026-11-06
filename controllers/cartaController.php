<?php
require_once __DIR__ . '/../models/Categorias.php';
require_once __DIR__ . '/../dao/CategoriasDAO.php';
require_once __DIR__ . '/../models/productos.php';
require_once __DIR__ . '/../dao/productosDAO.php';

class CartaController {

    public function index() {
        $categorias = categoriasDAO::selectAll();
        $productos = productosDAO::selectAll();
        $productoMasPedido = productosDAO::selectMasPedido();
        $productosRandom = productosDAO::selectRandom();

        $categoriaActivaId = isset($_GET['id'])
            ? $_GET['id']
            : (isset($categorias[0]) ? $categorias[0]->getId() : 0);

        $nombreCategoria = '';
        foreach ($categorias as $categoria) {
            if ($categoria->getId() == $categoriaActivaId) {
                $nombreCategoria = $categoria->getNombre();
                break;
            }
        }

        $view = __DIR__ . '/../views/carta.php';
        $css = 'carta.css';
        $js = 'carta.js';

        require_once __DIR__ . '/../views/main.php';
    }
}
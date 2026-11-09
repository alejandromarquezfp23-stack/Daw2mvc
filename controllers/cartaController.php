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

        $categoriaActivaId = null;
        $requestedCategoriaId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if ($requestedCategoriaId !== false && $requestedCategoriaId !== null) {
            foreach ($categorias as $categoria) {
                if ((int) $categoria->getId() === $requestedCategoriaId) {
                    $categoriaActivaId = $requestedCategoriaId;
                    break;
                }
            }
        }

        $titulo = 'Carta de Appletito';
        $view = __DIR__ . '/../views/carta.php';
        $css = 'carta.css';
        $js = 'carta.js';

        require_once __DIR__ . '/../views/main.php';
    }
}
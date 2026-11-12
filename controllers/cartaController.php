<?php
require_once __DIR__ . '/../models/Categorias.php';
require_once __DIR__ . '/../dao/CategoriasDAO.php';
require_once __DIR__ . '/../models/productos.php';
require_once __DIR__ . '/../dao/productosDAO.php';

class CartaController {

    public function index() {
        $categorias = categoriasDAO::selectAll();
        $productos = '';
        $productoMasPedido = productosDAO::selectMasPedido();
        $productosRandom = productosDAO::selectRandom();
        // $productoporID = productosDAO::selectOrderID();
        // $productoporNombre = productosDAO::selectOrderNombre();
        // $productoporPrecio = productosDAO::selectOrderPrecio();

        $categoriaActivaId = null;
        $requestedCategoriaId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $requestedCategoriaId = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        }

        if ($requestedCategoriaId !== false && $requestedCategoriaId !== null) {
            foreach ($categorias as $categoria) {
                if ((int) $categoria->getId() === $requestedCategoriaId) {
                    $categoriaActivaId = $requestedCategoriaId;
                    break;
                }
            }
        }

        if (isset($_POST['filtroid'])) {
            $productos = productosDAO::selectOrderID();
        } else if (isset($_POST['filtronombre'])) {
            $productos = productosDAO::selectOrderNombre();
        } else if (isset($_POST['filtroprecio'])) {
            $productos = productosDAO::selectOrderPrecio();
        } else {
            $productos = productosDAO::selectAll();
        }

        $titulo = 'Carta de Appletito';
        $view = __DIR__ . '/../views/carta.php';
        $css = 'carta.css';
        $js = 'carta.js';

        require_once __DIR__ . '/../views/main2.php';
    }
}
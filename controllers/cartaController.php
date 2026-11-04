<?php
require_once __DIR__ . '/../config/DataBase.php';
require_once __DIR__ . '/../models/Categorias.php';
require_once __DIR__ . '/../dao/CategoriasDAO.php';
require_once __DIR__ . '/../models/productos.php';
require_once __DIR__ . '/../dao/productosDAO.php';

class CartaController {

    public function index() {
        $conexion = DataBase::connect();

        $categoriasDAO = new CategoriasDAO($conexion);
        $categorias = $categoriasDAO->selectAll();

        $productosDAO = new productosDAO($conexion);
        $productos = $productosDAO->selectAll();

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

        require_once __DIR__ . '/../views/carta.php';
    }
}
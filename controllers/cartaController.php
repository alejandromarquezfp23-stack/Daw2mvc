<?php
require_once __DIR__ . '/../config/DataBase.php';
require_once __DIR__ . '/../models/Categorias.php';
require_once __DIR__ . '/../dao/CategoriasDAO.php';
require_once __DIR__ . '/../models/productos.php';
require_once __DIR__ . '/../dao/productosDAO.php';

class CartaController {

    public function index() {
        $conexion = DataBase::connect();

        // 1. Obtener categorías desde la BD
        $categoriasDAO = new CategoriasDAO($conexion);
        $categorias = $categoriasDAO->selectAll();

        // 2. Obtener productos desde la BD
        $productosDAO = new productosDAO($conexion);
        $productos = $productosDAO->selectAll();

        // 3. Obtener ID de la categoría activa
        $categoriaActivaId = isset($_GET['id'])
            ? $_GET['id']
            : (isset($categorias[0]) ? $categorias[0]->getId() : 0);

        // 4. Buscar el nombre de la categoría activa
        $nombreCategoria = '';
        foreach ($categorias as $categoria) {
            if ($categoria->getId() == $categoriaActivaId) {
                $nombreCategoria = $categoria->getNombre();
                break;
            }
        }

        // 5. Cargar la vista HTML (tendrá acceso a $categorias, $productos, $categoriaActivaId y $nombreCategoria)
        require_once __DIR__ . '/../views/carta.php';
    }
}
<?php
    require_once __DIR__ . '/../config/DataBase.php';
    require_once __DIR__ . '/../models/productos.php';
    require_once __DIR__ . '/../dao/productosDAO.php';
    require_once __DIR__ . '/../models/ingredientes.php';
    require_once __DIR__ . '/../dao/ingredientesDAO.php';
    require_once __DIR__ . '/../models/producto_ingrediente.php';
    require_once __DIR__ . '/../dao/producto_ingredienteDAO.php';

    class DetalleProductoController {
        public function index() {
            $id = $_GET['id'];

            $conexion = DataBase::connect();
            $productosDAO = new productosDAO($conexion);
            $productos = $productosDAO->selectAll();

            $productoActivo = null;

            foreach ($productos as $producto) {
                if ($producto->getId() == $id) {
                    $productoActivo = $producto;
                    break;
                }
            }

            $ingredientesDAO = new ingredientesDAO($conexion);
            $ingredientes = $ingredientesDAO->selectAll();

            $producto_ingredienteDAO = new producto_ingredienteDAO($conexion);
            $producto_ingrediente = $producto_ingredienteDAO->selectAll();

            $ingredientesProducto = [];
            foreach ($producto_ingrediente as $relacion) {
                if ($relacion->getProductoId() == $productoActivo->getId()) {
                    $ingredientesProducto[] = $relacion;
                }
            }

            $ingredientesActivos = [];
            foreach ($ingredientesProducto as $relacion) {
                foreach ($ingredientes as $ingrediente) {
                    if ($ingrediente->getId() == $relacion->getIngredienteId()) {
                        $ingredientesActivos[] = $ingrediente;
                    }
                }
            }

            require_once __DIR__ . '/../views/detalleproducto.php';
        }
    }
?>
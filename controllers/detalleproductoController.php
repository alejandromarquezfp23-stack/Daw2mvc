<?php
    require_once __DIR__ . '/../models/productos.php';
    require_once __DIR__ . '/../dao/productosDAO.php';
    require_once __DIR__ . '/../models/ingredientes.php';
    require_once __DIR__ . '/../dao/ingredientesDAO.php';
    require_once __DIR__ . '/../models/producto_ingrediente.php';
    require_once __DIR__ . '/../dao/producto_ingredienteDAO.php';

    class DetalleProductoController {
        public function index() {
            $id = $_GET['id'];

            $productoActivo = productosDAO::selectByID($id);

            $ingredientes = ingredientesDAO::selectAll();

            $producto_ingrediente = producto_ingredienteDAO::selectAll();

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

            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            if (!isset($_SESSION['carrito'])) {
                $_SESSION['carrito'] = [];
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $productoId = $_POST['producto_id'] ?? null;
                $accion = $_POST['accion'] ?? null;

                if ($productoId && $accion === 'continuar') {
                    if (isset($_SESSION['carrito'][$productoId])) {
                        $_SESSION['carrito'][$productoId]++;
                    } else {
                        $_SESSION['carrito'][$productoId] = 1;
                    }

                    $_SESSION['mensaje_exito'] = "¡Producto añadido al carrito correctamente!";
                    header('Location: /Daw2mvc/index.php?controller=carrito');
                    exit;
                }
            }

            $view = __DIR__ . '/../views/detalleproducto.php';
            $css = 'detalleproducto.css';
            require_once __DIR__ . '/../views/main3.php';
        }
    }
?>
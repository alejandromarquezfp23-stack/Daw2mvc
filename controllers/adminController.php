<?php
    require_once __DIR__ . '/../models/Camiseta.php';
    require_once __DIR__ . '/../models/Producto.php';
    require_once __DIR__ . '/../models/categorias.php';
    require_once __DIR__ . '/../models/favoritos.php';
    require_once __DIR__ . '/../models/ingredientes.php';
    require_once __DIR__ . '/../models/ofertas.php';
    require_once __DIR__ . '/../models/oferta_producto.php';
    require_once __DIR__ . '/../models/pedidos.php';
    require_once __DIR__ . '/../models/pedido_detalle.php';
    require_once __DIR__ . '/../models/pedido_detalle_ingrediente.php';
    require_once __DIR__ . '/../models/producto_ingrediente.php';
    require_once __DIR__ . '/../models/productos.php';
    require_once __DIR__ . '/../models/usuarios.php';

    require_once __DIR__ . '/../dao/CamisetaDAO.php';
    require_once __DIR__ . '/../dao/categoriasDAO.php';
    require_once __DIR__ . '/../dao/favoritosDAO.php';
    require_once __DIR__ . '/../dao/ingredientesDAO.php';
    require_once __DIR__ . '/../dao/ofertasDAO.php';
    require_once __DIR__ . '/../dao/oferta_productoDAO.php';
    require_once __DIR__ . '/../dao/pedidosDAO.php';
    require_once __DIR__ . '/../dao/pedido_detalleDAO.php';
    require_once __DIR__ . '/../dao/pedido_detalle_ingredienteDAO.php';
    require_once __DIR__ . '/../dao/producto_ingredienteDAO.php';
    require_once __DIR__ . '/../dao/productosDAO.php';
    require_once __DIR__ . '/../dao/usuariosDAO.php';

    class AdminController {
        public function index() {
            // if (session_status() === PHP_SESSION_NONE) {
            //     session_start();
            // }

            // if (!isset($_SESSION['usuario']->rol) || $_SESSION['usuario']->rol !== 'admin') {
            //     http_response_code(403);
            //     exit('No tienes permiso para acceder a esta página.');
            // }

            $productosJSON = productosDAO::selectAllJSON();
            $categoriasJSON = categoriasDAO::selectAllJSON();
            $ingredientesJSON = ingredientesDAO::selectAllJSON();
            $producto_ingredienteJSON = producto_ingredienteDAO::selectAllJSON();
            $favoritosJSON = favoritosDAO::selectAllJSON();
            $ofertasJSON = ofertasDAO::selectAllJSON();
            $oferta_productoJSON =oferta_productoDAO::selectAllJSON();
            $pedidosJSON = pedidosDAO::selectAllJSON();
            $pedido_detalleJSON = pedido_detalleDAO::selectAllJSON();
            $pedido_detalle_ingredienteJSON = pedido_detalle_ingredienteDAO::selectAllJSON();
            $usuariosJSON = usuariosDAO::selectAllJSON();
            $camisetasJSON = CamisetaDAO::getAllJSON();

            $productos = productosDAO::selectAll();
            $categorias = categoriasDAO::selectAll();
            $ingredientes = ingredientesDAO::selectAll();
            $productoIngredientes = producto_ingredienteDAO::selectAll();
            $favoritos = favoritosDAO::selectAll();
            $ofertas = ofertasDAO::selectAll();
            $ofertaProductos = oferta_productoDAO::selectAll();
            $pedidos = pedidosDAO::selectAll();
            $pedidoDetalles = pedido_detalleDAO::selectAll();
            $pedidoDetalleIngredientes = pedido_detalle_ingredienteDAO::selectAll();
            $usuarios = usuariosDAO::selectAll();
            $camisetas = CamisetaDAO::getAll();
        
            $view = __DIR__ . '/../views/admin.php';
            $titulo = 'Panel de Administrador Appletito';
            $js = 'admin.js';

            require __DIR__ . '/../views/main.php';
        }
    }
?>
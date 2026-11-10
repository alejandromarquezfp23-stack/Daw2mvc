<?php
    require_once __DIR__ . '/../models/pedidos.php';
    require_once __DIR__ . '/../dao/pedidosDAO.php';
    require_once __DIR__ . '/../models/pedido_detalle.php';
    require_once __DIR__ . '/../dao/pedido_detalleDAO.php';
    require_once __DIR__ . '/../models/usuarios.php';
    require_once __DIR__ . '/../dao/usuariosDAO.php';
    require_once __DIR__ . '/../models/favoritos.php';
    require_once __DIR__ . '/../dao/favoritosDAO.php';

    class PerfilController {
        public function index() {       
            if (!isset($_SESSION['usuario'])) {
                header("Location: index.php?controller=login");
                exit();
            }

            $usuarioID = $_SESSION['usuario']->id;
            $usuario = usuariosDAO::selectByID($usuarioID);

            $gestionar_saldo = false;
            $historial_pedidos = false;
            $ver_favoritos = false;

            if (isset($_POST['gestionar_saldo'])) {
                $gestionar_saldo = true;
            }

            if (isset($_POST['historial_pedidos'])) {
                $historial_pedidos = true;
            }

            if (isset($_POST['ver_favoritos'])) {
                $ver_favoritos = true;
            }

            $pedidosUsuario = $historial_pedidos ? pedidosDAO::selectByUsuarioID($usuarioID) : [];
            $pedidodetalle = $historial_pedidos ? pedido_detalleDAO::selectAll() : [];
            $favoritosUsuario = $ver_favoritos ? favoritosDAO::selectByUsuarioID($usuarioID) : [];
            
            $titulo = 'Perfil en Appletito';
            $view = __DIR__ . '/../views/perfil.php';
            $css = 'perfil.css';
            $js = 'carta.js';
            require_once __DIR__ . '/../views/main3.php';
        }
    }
?>
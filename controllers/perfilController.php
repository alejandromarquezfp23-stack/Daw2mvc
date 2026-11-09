<?php
    require_once __DIR__ . '/../models/pedidos.php';
    require_once __DIR__ . '/../dao/pedidosDAO.php';
    require_once __DIR__ . '/../models/usuarios.php';
    require_once __DIR__ . '/../dao/usuariosDAO.php';

    class PerfilController {
        public function index() {       
            $pedidos = pedidosDAO::selectAll();
            $usuarios = usuariosDAO::selectAll();

            $usuarioID = $_SESSION['usuario']->id;
            $usuario = usuariosDAO::selectByID($usuarioID);

            $view = __DIR__ . '/../views/perfil.php';
            $css = 'perfil.css';
            $js = '';
            require_once __DIR__ . '/../views/main3.php';
        }
    }
?>
<?php
    require_once __DIR__ . '/../models/usuarios.php';
    require_once __DIR__ . '/../dao/usuariosDAO.php';

    class loginController {
        public function index() {
            $view = __DIR__ . '/../views/login.php';
            $css = 'login.css';
            require_once __DIR__ . '/../views/main3.php';
        }
    }
?>
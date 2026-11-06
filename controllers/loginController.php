<?php
require_once __DIR__ . '/../models/usuarios.php';
require_once __DIR__ . '/../dao/usuariosDAO.php';

class loginController {
    public function index() {
        $loginCorrecto = false;

        if (isset($_POST['login'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $usuario = usuariosDAO::selectUserCorrect($email);

            if ($usuario && password_verify($password, $usuario->getPassword())) {
                $_SESSION['usuario'] = $usuario;
                $loginCorrecto = true;
            }
        }

        $view = __DIR__ . '/../views/login.php';
        $css = 'login.css';
        $js = 'login.js';
        require_once __DIR__ . '/../views/main3.php';
    }
}
?>
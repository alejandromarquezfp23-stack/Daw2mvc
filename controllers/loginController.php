<?php
require_once __DIR__ . '/../models/usuarios.php';
require_once __DIR__ . '/../dao/usuariosDAO.php';

class loginController {
    public function index() {
        $loginCorrecto = null;

        if (isset($_POST['login'])) {
            $loginCorrecto = false;
            $email = $_POST['email'];
            $password = $_POST['password'];

            $usuario = usuariosDAO::selectByEmail($email);

            if ($usuario && password_verify($password, $usuario->password)) {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }

                session_regenerate_id(true);
                $_SESSION['usuario'] = $usuario;

                $loginCorrecto = true;
            }
        }

        $view = __DIR__ . '/../views/login.php';
        $css = 'login.css';
        $js = 'login.js';
        require_once __DIR__ . '/../views/main3.php';
    }

    public function logout() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit;
        }

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION = [];
        session_destroy();

        header('Location: /Daw2mvc/index.php?controller=login');
        exit;
    }
}
?>
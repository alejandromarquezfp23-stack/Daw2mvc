<?php
require_once __DIR__ . '/../models/usuarios.php';
require_once __DIR__ . '/../dao/usuariosDAO.php';

class RegistroController {
    public function index() {
        $registroCorrecto = null;

        if (isset($_POST['registro'])) {
            $nombre = trim($_POST['nombre'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $telefono = trim($_POST['telefono'] ?? '');
            $direccion = trim($_POST['direccion'] ?? '');
            $fecha_nacimiento = $_POST['fecha_nacimiento'] ?? '';

            if (usuariosDAO::selectByEmail($email)) {
                $registroCorrecto = false;
            } else {
                $usuario = new usuarios(null, $nombre, $email, password_hash($password, PASSWORD_DEFAULT), $telefono, $direccion, $fecha_nacimiento !== '' ? $fecha_nacimiento : null, 'usuario');
                usuariosDAO::insert($usuario);
                $registroCorrecto = true;
            }
        }

        $titulo = 'Registro de Appletito';
        $view = __DIR__ . '/../views/registro.php';
        $css = 'login.css';
        $js = 'registro.js';
        require_once __DIR__ . '/../views/main3.php';
    }
}

?>
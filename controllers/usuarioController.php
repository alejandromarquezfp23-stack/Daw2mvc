<?php
    require_once __DIR__ . '/../models/usuarios.php';
    require_once __DIR__ . '/../dao/usuariosDAO.php';
    require_once __DIR__ . '/../models/pedidos.php';
    require_once __DIR__ . '/../dao/pedidosDAO.php';
    require_once __DIR__ . '/../models/pedido_detalle.php';
    require_once __DIR__ . '/../dao/pedido_detalleDAO.php';
    require_once __DIR__ . '/../models/favoritos.php';
    require_once __DIR__ . '/../dao/favoritosDAO.php';

    class UsuarioController {
        public function index() {
            $this->login();
        }

        public function login() {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            $loginCorrecto = null;

            if (isset($_POST['login'])) {
                $email = trim($_POST['email'] ?? '');
                $password = $_POST['password'] ?? '';
                $usuario = usuariosDAO::selectByEmail($email);

                $loginCorrecto = false;

                if ($usuario && password_verify($password, $usuario->password)) {
                    session_regenerate_id(true);
                    $_SESSION['usuario'] = $usuario;
                    $loginCorrecto = true;
                }
            }

            $titulo = 'Login en Appletito';
            $view = __DIR__ . '/../views/login.php';
            $css = 'login.css';
            $js = 'login.js';
            require __DIR__ . '/../views/main3.php';
        }

        public function create() {
            $registroCorrecto = null;

            $titulo = 'Registro de Appletito';
            $view = __DIR__ . '/../views/registro.php';
            $css = 'login.css';
            $js = 'registro.js';
            require __DIR__ . '/../views/main3.php';
        }

        public function store() {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                http_response_code(405);
                exit;
            }

            $registroCorrecto = false;

            if (isset($_POST['registro'])) {
                $nombre = trim($_POST['nombre'] ?? '');
                $email = trim($_POST['email'] ?? '');
                $password = $_POST['password'] ?? '';
                $telefono = trim($_POST['telefono'] ?? '');
                $direccion = trim($_POST['direccion'] ?? '');
                $fechaNacimiento = $_POST['fecha_nacimiento'] ?? '';

                if (!usuariosDAO::selectByEmail($email)) {
                    $usuario = new usuarios(
                        null,
                        $nombre,
                        $email,
                        password_hash($password, PASSWORD_DEFAULT),
                        $telefono,
                        $direccion,
                        $fechaNacimiento !== '' ? $fechaNacimiento : null,
                        'usuario'
                    );

                    usuariosDAO::insert($usuario);
                    $registroCorrecto = true;
                }
            }

            $titulo = 'Registro de Appletito';
            $view = __DIR__ . '/../views/registro.php';
            $css = 'login.css';
            $js = 'registro.js';
            require __DIR__ . '/../views/main3.php';
        }

        public function show() {
            $this->requireLogin();

            $usuarioID = $_SESSION['usuario']->id;
            $usuario = usuariosDAO::selectByID($usuarioID);

            $gestionar_saldo = isset($_POST['gestionar_saldo']);
            $historial_pedidos = isset($_POST['historial_pedidos']);
            $ver_favoritos = isset($_POST['ver_favoritos']);

            $pedidosUsuario = $historial_pedidos
                ? pedidosDAO::selectByUsuarioID($usuarioID)
                : [];

            $pedidodetalle = $historial_pedidos
                ? pedido_detalleDAO::selectAll()
                : [];

            $favoritosUsuario = $ver_favoritos
                ? favoritosDAO::selectByUsuarioID($usuarioID)
                : [];

            $titulo = 'Perfil en Appletito';
            $view = __DIR__ . '/../views/perfil.php';
            $css = 'perfil.css';
            $js = 'carta.js';
            require __DIR__ . '/../views/main3.php';
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

            header('Location: /Daw2mvc/index.php?controller=usuario&action=login');
            exit;
        }

        private function requireLogin() {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            if (!isset($_SESSION['usuario'])) {
                header('Location: /Daw2mvc/index.php?controller=usuario&action=login');
                exit;
            }
        }
    }
?>
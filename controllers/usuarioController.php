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
        // La ruta principal del controlador muestra el formulario de acceso.
        public function index() {
            $this->login();
        }

        // Comprueba las credenciales y muestra el formulario de inicio de sesión.
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

                if ($usuario && password_verify($password, $usuario->getPassword())) {
                    // Renueva el identificador de sesión tras autenticar al usuario.
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

        // Muestra el formulario de registro.
        public function create() {
            $registroCorrecto = null;

            $titulo = 'Registro de Appletito';
            $view = __DIR__ . '/../views/registro.php';
            $css = 'login.css';
            $js = 'registro.js';
            require __DIR__ . '/../views/main3.php';
        }

        // Valida el registro y guarda la contraseña cifrada si el correo está disponible.
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

                // Evita crear otra cuenta con una dirección de correo ya registrada.
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

        // Carga los datos de perfil, historial de pedidos y favoritos solicitados.
        public function show() {
            $this->requireLogin();

            $usuarioID = $_SESSION['usuario']->getID();
            $usuario = usuariosDAO::selectByID($usuarioID);

            $gestionar_cuenta = isset($_POST['gestionar_cuenta']);
            $historial_pedidos = isset($_POST['historial_pedidos']) || isset($_GET['historial_pedidos']);
            $ver_favoritos = isset($_POST['ver_favoritos']);

            // ACTUALIZAR NOMBRE
            if (isset($_POST['guardarNombre'])) {
                $usuario->setNombre(trim($_POST['nuevoNombre']));
                usuariosDAO::update($usuario);
            }

            // ACTUALIZAR EMAIL
            if (isset($_POST['guardarEmail'])) {
                $usuario->setEmail(trim($_POST['nuevoEmail']));
                usuariosDAO::update($usuario);
            }

            // ACTUALIZAR TELÉFONO
            if (isset($_POST['guardarTelefono'])) {
                $usuario->setTelefono(trim($_POST['nuevoTelefono']));
                usuariosDAO::update($usuario);
            }

            // ACTUALIZAR DIRECCIÓN
            if (isset($_POST['guardarDireccion'])) {
                $usuario->setDireccion(trim($_POST['nuevaDireccion']));
                usuariosDAO::update($usuario);
            }

            // ACTUALIZAR FECHA DE NACIMIENTO
            if (isset($_POST['guardarFecha'])) {
                $usuario->setFechaNacimiento($_POST['nuevaFecha']);
                usuariosDAO::update($usuario);
            }

            // Volver a cargar los datos actualizados
            $usuario = usuariosDAO::selectByID($usuarioID);

            $filtroActivo = null;
            $ordenPedidos = 'fecha';

            // El botón enviado determina cómo se ordena el historial.
            if (isset($_POST['filtroidpedido'])) {
                $filtroActivo = 'id';
                $ordenPedidos = 'id';
            } elseif (isset($_POST['filtrofechapedido'])) {
                $filtroActivo = 'fecha';
                $ordenPedidos = 'fecha';
            } elseif (isset($_POST['filtropreciopedido'])) {
                $filtroActivo = 'precio';
                $ordenPedidos = 'precio';
            }

            $pedidosUsuario = $historial_pedidos
                ? pedidosDAO::selectByUsuarioID($usuarioID, $ordenPedidos)
                : [];

            $pedidodetalle = [];
            // Carga los productos de cada pedido para que la vista pueda mostrar el historial.
            foreach ($pedidosUsuario as $pedido) {
                $pedidodetalle[$pedido->getId()] = pedido_detalleDAO::selectByPedidoID($pedido->getId());
            }

            $favoritosUsuario = $ver_favoritos
                ? favoritosDAO::selectByUsuarioID($usuarioID)
                : [];

            $titulo = 'Perfil en Appletito';
            $view = __DIR__ . '/../views/perfil.php';
            $css = 'perfil.css';
            $js = 'carta.js';
            require __DIR__ . '/../views/main3.php';
        }

        // Cierra la sesión y redirige al formulario de acceso.
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

            header('Location: ' . url . 'index.php?controller=usuario&action=login');
            exit;
        }

        // Redirige al acceso si no hay un usuario conectado.
        private function requireLogin() {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            if (!isset($_SESSION['usuario'])) {
                header('Location: ' . url . 'index.php?controller=usuario&action=login');
                exit;
            }
        }
    }
?>
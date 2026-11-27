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
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            if (!isset($_SESSION['usuario']) || $_SESSION['usuario']->getRol() !== 'admin') {
                showError(403, 'No tienes permiso para acceder a esta página.');
            }

            $view = __DIR__ . '/../views/admin.php';
            $titulo = 'Panel de Administrador Appletito';
            $js = 'admin.js';

            require __DIR__ . '/../views/main.php';
        }

        public function apiProducto() {
            $metodo = $_SERVER['REQUEST_METHOD'];

            if ($metodo == 'GET') {
                $productos = productosDAO::selectAllJSON();
                echo json_encode($productos);

            } else if ($metodo == 'POST') {
                $datos = json_decode(file_get_contents('php://input'), true);

                $producto = new productos(
                    null,
                    $datos['categoria_id'],
                    $datos['nombre'],
                    $datos['descripcion'],
                    $datos['precio'],
                    $datos['imagen'],
                    $datos['activo']
                );

                $id = productosDAO::insert($producto);
                echo json_encode(['success' => $id > 0, 'id' => $id]);

            } else if ($metodo == 'PUT') {
                $datos = json_decode(file_get_contents('php://input'), true);

                $producto = new productos(
                    $datos['id'],
                    $datos['categoria_id'],
                    $datos['nombre'],
                    $datos['descripcion'],
                    $datos['precio'],
                    $datos['imagen'],
                    $datos['activo']
                );

                $resultado = productosDAO::update($producto);
                echo json_encode(['success' => $resultado]);

            } else if ($metodo == 'DELETE') {
                $datos = json_decode(file_get_contents('php://input'), true);

                $resultado = productosDAO::delete($datos['id']);
                echo json_encode(['success' => $resultado]);
            }
        }

        public function apiCategoria() {
            $metodo = $_SERVER['REQUEST_METHOD'];

            if ($metodo == 'GET') {
                $categorias = categoriasDAO::selectAllJSON();
                echo json_encode($categorias);

            } else if ($metodo == 'POST') {
                $datos = json_decode(file_get_contents('php://input'), true);

                $categoria = new categorias(
                    null,
                    $datos['nombre'],
                    $datos['descripcion'],
                    $datos['imagen'],
                    $datos['activo']
                );

                $id = categoriasDAO::insert($categoria);
                echo json_encode(['success' => $id > 0, 'id' => $id]);

            } else if ($metodo == 'PUT') {
                $datos = json_decode(file_get_contents('php://input'), true);

                $categoria = new categorias(
                    $datos['id'],
                    $datos['nombre'],
                    $datos['descripcion'],
                    $datos['imagen'],
                    $datos['activo']
                );

                $resultado = categoriasDAO::update($categoria);
                echo json_encode(['success' => $resultado]);

            } else if ($metodo == 'DELETE') {
                $datos = json_decode(file_get_contents('php://input'), true);

                $resultado = categoriasDAO::delete($datos['id']);
                echo json_encode(['success' => $resultado]);
            }
        }

        public function apiIngrediente() {
            $metodo = $_SERVER['REQUEST_METHOD'];

            if ($metodo == 'GET') {
                $ingredientes = ingredientesDAO::selectAllJSON();
                echo json_encode($ingredientes);

            } else if ($metodo == 'POST') {
                $datos = json_decode(file_get_contents('php://input'), true);

                $ingrediente = new ingredientes(
                    null,
                    $datos['nombre'],
                    $datos['imagen'],
                    $datos['precio_extra'],
                    $datos['activo']
                );

                $id = ingredientesDAO::insert($ingrediente);
                echo json_encode(['success' => $id > 0, 'id' => $id]);

            } else if ($metodo == 'PUT') {
                $datos = json_decode(file_get_contents('php://input'), true);

                $ingrediente = new ingredientes(
                    $datos['id'],
                    $datos['nombre'],
                    $datos['imagen'],
                    $datos['precio_extra'],
                    $datos['activo']
                );

                $resultado = ingredientesDAO::update($ingrediente);
                echo json_encode(['success' => $resultado]);

            } else if ($metodo == 'DELETE') {
                $datos = json_decode(file_get_contents('php://input'), true);

                $resultado = ingredientesDAO::delete($datos['id']);
                echo json_encode(['success' => $resultado]);
            }
        }

        public function apiOferta() {
            $metodo = $_SERVER['REQUEST_METHOD'];

            if ($metodo == 'GET') {
                $ofertas = ofertasDAO::selectAllJSON();
                echo json_encode($ofertas);

            } else if ($metodo == 'POST') {
                $datos = json_decode(file_get_contents('php://input'), true);

                $oferta = new ofertas(
                    null,
                    $datos['nombre'],
                    $datos['descripcion'],
                    $datos['tipo'],
                    $datos['valor'],
                    $datos['codigo'],
                    $datos['fecha_inicio'],
                    $datos['fecha_fin'],
                    $datos['activa']
                );

                $id = ofertasDAO::insert($oferta);
                echo json_encode(['success' => $id > 0, 'id' => $id]);

            } else if ($metodo == 'PUT') {
                $datos = json_decode(file_get_contents('php://input'), true);

                $oferta = new ofertas(
                    $datos['id'],
                    $datos['nombre'],
                    $datos['descripcion'],
                    $datos['tipo'],
                    $datos['valor'],
                    $datos['codigo'],
                    $datos['fecha_inicio'],
                    $datos['fecha_fin'],
                    $datos['activa']
                );

                $resultado = ofertasDAO::update($oferta);
                echo json_encode(['success' => $resultado]);

            } else if ($metodo == 'DELETE') {
                $datos = json_decode(file_get_contents('php://input'), true);

                $resultado = ofertasDAO::delete($datos['id']);
                echo json_encode(['success' => $resultado]);
            }
        }

        public function apiPedido() {
            $metodo = $_SERVER['REQUEST_METHOD'];

            if ($metodo == 'GET') {
                $pedidos = pedidosDAO::selectAllJSON();
                echo json_encode($pedidos);

            } else if ($metodo == 'PUT') {
                $datos = json_decode(file_get_contents('php://input'), true);

                $pedido = pedidosDAO::selectByID($datos['id']);

                if ($pedido != null) {
                    $pedido->setEstado($datos['estado']);
                    $pedido->setEstadoPago($datos['estado_pago']);

                    $resultado = pedidosDAO::update($pedido);
                    echo json_encode(['success' => $resultado]);
                } else {
                    echo json_encode(['success' => false]);
                }
            }
        }

        public function apiUsuario() {
            $metodo = $_SERVER['REQUEST_METHOD'];

            if ($metodo == 'GET') {
                $usuarios = usuariosDAO::selectAllJSON();
                echo json_encode($usuarios);

            } else if ($metodo == 'PUT') {
                $datos = json_decode(file_get_contents('php://input'), true);

                $usuario = usuariosDAO::selectByID($datos['id']);

                if ($usuario != null) {
                    $usuario->setNombre($datos['nombre']);
                    $usuario->setEmail($datos['email']);
                    $usuario->setTelefono($datos['telefono']);
                    $usuario->setDireccion($datos['direccion']);
                    $usuario->setFechaNacimiento($datos['fecha_nacimiento']);
                    $usuario->setRol($datos['rol']);

                    $resultado = usuariosDAO::update($usuario);
                    echo json_encode(['success' => $resultado]);
                } else {
                    echo json_encode(['success' => false]);
                }
            }
        }
    }
?>
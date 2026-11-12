<?php
    require_once __DIR__ . '/../models/productos.php';
    require_once __DIR__ . '/../dao/productosDAO.php';
    require_once __DIR__ . '/../models/ingredientes.php';
    require_once __DIR__ . '/../dao/ingredientesDAO.php';
    require_once __DIR__ . '/../models/producto_ingrediente.php';
    require_once __DIR__ . '/../dao/producto_ingredienteDAO.php';
    require_once __DIR__ . '/../models/favoritos.php';
    require_once __DIR__ . '/../dao/favoritosDAO.php';

    class DetalleProductoController {
        public function index() {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            $usuarioID = isset($_SESSION['usuario']) ? $_SESSION['usuario']->id : null;

            $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
            if (!$id || $id < 1) {
                showError(400, 'El producto indicado no es válido.');
            }

            $productoActivo = productosDAO::selectByID($id);
            if (!$productoActivo) {
                showError(404, 'No se ha encontrado el producto solicitado.');
            }

            $ingredientes = ingredientesDAO::selectAll();
            $ingredientesProducto = producto_ingredienteDAO::selectByProductoID($id);

            $ingredientesActivos = [];
            foreach ($ingredientesProducto as $relacion) {
                foreach ($ingredientes as $ingrediente) {
                    if (
                        $ingrediente->getId() == $relacion->getIngredienteId()
                        && $ingrediente->getActivo()
                    ) {
                        $ingredientesActivos[] = $ingrediente;
                        break;
                    }
                }
            }

            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            if (!isset($_SESSION['carrito'])) {
                $_SESSION['carrito'] = [];
            }

            $seleccionesIngredientes = [];
            $precioCentimos = (int) round((float) $productoActivo->getPrecio() * 100);
            $mensajeFavoritos = null;
            $tipoMensajeFavoritos = 'success';

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $productoId = $_POST['producto_id'] ?? null;
                $accion = $_POST['accion'] ?? null;

                if (
                    (isset($_POST['accion']) || isset($_POST['productoInsertarFavoritos']) || isset($_POST['productoEliminarFavoritos']))
                    && (string) $productoId !== (string) $id
                ) {
                    showError(400, 'La solicitud para añadir el producto no es válida.');
                }

                if ($accion !== null && !in_array($accion, ['actualizar', 'continuar'], true)) {
                    showError(400, 'La acción solicitada no es válida.');
                }

                $selecciones = $_POST['ingredientes'] ?? [];
                if (!is_array($selecciones)) {
                    showError(400, 'La selección de ingredientes no es válida.');
                }

                $ingredientesPermitidos = [];
                foreach ($ingredientesActivos as $ingrediente) {
                    $ingredientesPermitidos[(int) $ingrediente->getId()] = $ingrediente;
                }

                $accionesIngredientes = [];
                $precioCentimos = (int) round((float) $productoActivo->getPrecio() * 100);
                foreach ($selecciones as $ingredienteId => $accionIngrediente) {
                    if (!ctype_digit((string) $ingredienteId) || !is_string($accionIngrediente)) {
                        showError(400, 'La selección de ingredientes no es válida.');
                    }

                    if ($accionIngrediente === '') {
                        continue;
                    }

                    $ingredienteId = (int) $ingredienteId;
                    if (
                        !isset($ingredientesPermitidos[$ingredienteId])
                        || !in_array($accionIngrediente, ['anadir', 'quitar'], true)
                    ) {
                        showError(400, 'La selección contiene un ingrediente o una acción no válida.');
                    }

                    $ingrediente = $ingredientesPermitidos[$ingredienteId];
                    $ajusteCentimos = (int) round((float) $ingrediente->getPrecioExtra() * 100);
                    $precioCentimos += $accionIngrediente === 'anadir'
                        ? $ajusteCentimos
                        : -$ajusteCentimos;
                    $seleccionesIngredientes[$ingredienteId] = $accionIngrediente;
                }

                if ($precioCentimos < 0) {
                    showError(400, 'El precio final del producto no puede ser negativo.');
                }

                if ($accion === 'continuar') {
                    $accionesIngredientes = $seleccionesIngredientes;
                    ksort($accionesIngredientes, SORT_NUMERIC);
                    $claveConfiguracion = $id . ':' . sha1(json_encode($accionesIngredientes));
                    if (
                        isset($_SESSION['carrito'][$claveConfiguracion])
                        && is_array($_SESSION['carrito'][$claveConfiguracion])
                    ) {
                        $_SESSION['carrito'][$claveConfiguracion]['cantidad']++;
                    } else {
                        $_SESSION['carrito'][$claveConfiguracion] = [
                            'producto_id' => (int) $id,
                            'cantidad' => 1,
                            'precio_unitario' => $precioCentimos / 100,
                            'ingredientes' => $accionesIngredientes
                        ];
                    }

                    $_SESSION['mensaje_exito'] = '¡Producto añadido al carrito correctamente!';
                    header('Location: /Daw2mvc/index.php?controller=carrito');
                    exit;
                }
            }

            if (isset($_POST['productoInsertarFavoritos'])) {
                if (!$usuarioID) {
                    $mensajeFavoritos = 'Debes iniciar sesión para guardar productos en favoritos.';
                    $tipoMensajeFavoritos = 'danger';
                } else {
                    if (!favoritosDAO::selectByIDs((int) $id, (int) $usuarioID)) {
                        $productoFavorito = new favoritos((int) $id, (int) $usuarioID);
                        favoritosDAO::insert($productoFavorito);
                        $mensajeFavoritos = 'Producto añadido a favoritos.';
                    } else {
                        $mensajeFavoritos = 'Este producto ya está en tus favoritos.';
                    }
                }
            } else if (isset($_POST['productoEliminarFavoritos'])) {
                if (!$usuarioID) {
                    $mensajeFavoritos = 'Debes iniciar sesión para modificar tus favoritos.';
                    $tipoMensajeFavoritos = 'danger';
                } else {
                    favoritosDAO::delete((int) $id, (int) $usuarioID);
                    $mensajeFavoritos = 'Producto eliminado de favoritos.';
                }
            }

            $esFavorito = $usuarioID && favoritosDAO::selectByIDs((int) $id, (int) $usuarioID) !== null;

            $titulo = $productoActivo->getNombre() . ' de Appletito';
            $view = __DIR__ . '/../views/detalleproducto.php';
            $css = 'detalleproducto.css';
            require_once __DIR__ . '/../views/main3.php';
        }
    }
?>
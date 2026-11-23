<?php
    require_once __DIR__ . '/../models/categorias.php';
    require_once __DIR__ . '/../dao/categoriasDAO.php';
    require_once __DIR__ . '/../models/productos.php';
    require_once __DIR__ . '/../dao/productosDAO.php';
    require_once __DIR__ . '/../models/ingredientes.php';
    require_once __DIR__ . '/../dao/ingredientesDAO.php';
    require_once __DIR__ . '/../models/producto_ingrediente.php';
    require_once __DIR__ . '/../dao/producto_ingredienteDAO.php';

    class ProductosController {
        // Carga el catálogo y aplica la categoría o el orden solicitados.
        public function index() {
            $categorias = categoriasDAO::selectAll();
            $productoMasPedido = productosDAO::selectMasPedido();
            $productosRandom = productosDAO::selectRandom();
            $categoriaActivaId = null;
            // La categoría puede llegar tanto desde un enlace como desde un formulario.
            $categoriaId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $categoriaId = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
            }

            foreach ($categorias as $categoria) {
                if ((int) $categoria->getId() === $categoriaId) {
                    $categoriaActivaId = $categoriaId;
                    break;
                }
            }

            $filtroActivo = null;

            // Aplica el orden indicado; si no se eligió ninguno, muestra el orden normal.
            if (isset($_POST['filtroid'])) {
                $filtroActivo = 'id';
                $productos = productosDAO::selectOrderID();
            } elseif (isset($_POST['filtronombre'])) {
                $filtroActivo = 'nombre';
                $productos = productosDAO::selectOrderNombre();
            } elseif (isset($_POST['filtroprecio'])) {
                $filtroActivo = 'precio';
                $productos = productosDAO::selectOrderPrecio();
            } else {
                $productos = productosDAO::selectAll();
            }

            $titulo = 'Carta de Appletito';
            $view = __DIR__ . '/../views/carta.php';
            $css = 'carta.css';
            $js = 'carta.js';

            require __DIR__ . '/../views/main2.php';
        }

        // Prepara el detalle del producto y procesa las opciones de ingredientes.
        public function show() {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

            if (!$id || $id < 1) {
                showError(400, 'El producto indicado no es válido.');
            }

            $productoActivo = productosDAO::selectByID($id);

            if (!$productoActivo) {
                showError(404, 'No se ha encontrado el producto solicitado.');
            }

            if (!isset($_SESSION['carrito'])) {
                $_SESSION['carrito'] = [];
            }

            $ingredientesActivos = $this->obtenerIngredientesActivos($id);
            $configuracion = $this->procesarSolicitudDetalle($id, $productoActivo, $ingredientesActivos);

            $seleccionesIngredientes = $configuracion['selecciones'];
            $precioCentimos = $configuracion['precioCentimos'];

            $usuarioID = $_SESSION['usuario']->id ?? null;
            $esFavorito = false;

            if ($usuarioID) {
                require_once __DIR__ . '/../dao/favoritosDAO.php';
                $esFavorito = favoritosDAO::selectByIDs($id, $usuarioID) !== null;
            }

            $mensajeFavoritos = $_SESSION['mensaje_favoritos'] ?? null;
            $tipoMensajeFavoritos = $_SESSION['tipo_mensaje_favoritos'] ?? 'success';

            // Estos avisos son temporales y no deben repetirse en la siguiente visita.
            unset($_SESSION['mensaje_favoritos'], $_SESSION['tipo_mensaje_favoritos']);

            $titulo = $productoActivo->getNombre() . ' de Appletito';
            $view = __DIR__ . '/../views/detalleProducto.php';
            $css = 'detalleProducto.css';

            require __DIR__ . '/../views/main3.php';
        }

        // Devuelve solo los ingredientes activos asociados al producto.
        private function obtenerIngredientesActivos(int $productoId): array {
            $ingredientes = ingredientesDAO::selectAll();
            $relaciones = producto_ingredienteDAO::selectByProductoID($productoId);
            $ingredientesActivos = [];
            $ingredientesPorId = [];

            // Indexa los ingredientes para buscarlos rápidamente desde cada relación.
            foreach ($ingredientes as $ingrediente) {
                $ingredientesPorId[$ingrediente->getId()] = $ingrediente;
            }

            foreach ($relaciones as $relacion) {
                $idIngrediente = $relacion->getIngredienteId();

                if (isset($ingredientesPorId[$idIngrediente]) && $ingredientesPorId[$idIngrediente]->getActivo()) {
                    $ingredientesActivos[] = $ingredientesPorId[$idIngrediente];
                }
            }

            return $ingredientesActivos;
        }

        // Valida las opciones enviadas, ajusta el precio y prepara la selección.
        private function procesarSolicitudDetalle(int $id, $productoActivo, array $ingredientesActivos): array {
            $seleccionesIngredientes = [];
            $precioCentimos = (int) round((float) $productoActivo->getPrecio() * 100);

            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                return [
                    'selecciones' => $seleccionesIngredientes,
                    'precioCentimos' => $precioCentimos
                ];
            }

            $productoId = $_POST['producto_id'] ?? null;
            $accion = $_POST['accion'] ?? null;

            if (isset($_POST['accion']) && ($productoId === null || (string) $productoId !== (string) $id)) {
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

            // Solo se aceptarán ingredientes activos asociados a este producto.
            foreach ($ingredientesActivos as $ingrediente) {
                $ingredientesPermitidos[$ingrediente->getId()] = $ingrediente;
            }

            foreach ($selecciones as $ingredienteId => $accionIngrediente) {
                if (!ctype_digit((string) $ingredienteId) || !is_string($accionIngrediente)) {
                    showError(400, 'La selección de ingredientes no es válida.');
                }

                if ($accionIngrediente === '') {
                    continue;
                }

                if (!isset($ingredientesPermitidos[$ingredienteId]) || !in_array($accionIngrediente, ['anadir', 'quitar'], true)) {
                    showError(400, 'La selección contiene un ingrediente o una acción no válida.');
                }

                $ingrediente = $ingredientesPermitidos[$ingredienteId];
                $precioExtra = (int) round((float) $ingrediente->getPrecioExtra() * 100);

                if ($accionIngrediente === 'anadir') {
                    $precioCentimos += $precioExtra;
                } else {
                    $precioCentimos -= $precioExtra;
                }

                $seleccionesIngredientes[$ingredienteId] = $accionIngrediente;
            }

            if ($precioCentimos < 0) {
                showError(400, 'El precio final del producto no puede ser negativo.');
            }

            if ($accion === 'continuar') {
                $this->agregarAlCarrito($id, $precioCentimos, $seleccionesIngredientes);
            }

            return [
                'selecciones' => $seleccionesIngredientes,
                'precioCentimos' => $precioCentimos
            ];
        }

        // Agrupa en el carrito productos con la misma personalización.
        private function agregarAlCarrito(int $id, int $precioCentimos, array $ingredientes): void {
            // Ordenar las opciones hace que una misma combinación genere siempre la misma clave.
            ksort($ingredientes, SORT_NUMERIC);
            $claveCarrito = $id . ':' . sha1(json_encode($ingredientes));

            if (isset($_SESSION['carrito'][$claveCarrito])) {
                $_SESSION['carrito'][$claveCarrito]['cantidad']++;
            } else {
                $_SESSION['carrito'][$claveCarrito] = [
                    'producto_id' => $id,
                    'cantidad' => 1,
                    'precio_unitario' => $precioCentimos / 100,
                    'ingredientes' => $ingredientes
                ];
            }

            $_SESSION['mensaje_exito'] = '¡Producto añadido al carrito correctamente!';
            header('Location: ' . url . 'index.php?controller=carrito');
            exit;
        }
    }
?>
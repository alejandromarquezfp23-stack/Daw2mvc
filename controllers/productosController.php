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
        public function index() {
            $categorias = categoriasDAO::selectAll();
            $productoMasPedido = productosDAO::selectMasPedido();
            $productosRandom = productosDAO::selectRandom();
            $categoriaActivaId = null;
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

            if (isset($_POST['filtroid'])) {
                $productos = productosDAO::selectOrderID();
            } elseif (isset($_POST['filtronombre'])) {
                $productos = productosDAO::selectOrderNombre();
            } elseif (isset($_POST['filtroprecio'])) {
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

            unset($_SESSION['mensaje_favoritos'], $_SESSION['tipo_mensaje_favoritos']);

            $titulo = $productoActivo->getNombre() . ' de Appletito';
            $view = __DIR__ . '/../views/detalleproducto.php';
            $css = 'detalleproducto.css';

            require __DIR__ . '/../views/main3.php';
        }

        public function create() {

        }

        public function store() {

        }

        public function edit() {

        }

        public function update() {

        }

        public function destroy() {

        }

        private function obtenerIngredientesActivos(int $productoId): array {
            $ingredientes = ingredientesDAO::selectAll();
            $relaciones = producto_ingredienteDAO::selectByProductoID($productoId);
            $ingredientesActivos = [];
            $ingredientesPorId = [];

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

        private function agregarAlCarrito(int $id, int $precioCentimos, array $ingredientes): void {
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
            header('Location: /Daw2mvc/index.php?controller=carrito');
            exit;
        }
    }
?>
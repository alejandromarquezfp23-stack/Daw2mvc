<?php

include_once(__DIR__ . '/../dao/CamisetaDAO.php');
include_once(__DIR__ . '/../models/Camiseta.php');

class productoController
{
    // Tallas permitidas para las camisetas de este controlador.
    private const TALLAS_VALIDAS = ['XXL', 'XL', 'L', 'M', 'S'];

    // Obtiene todas las camisetas para mostrarlas en el listado.
    public function index()
    {
        $productos = CamisetaDAO::getAll();
        $view = "views/productos/listado.php";
        include_once 'views/main.php';
    }

    // Muestra el formulario para crear una camiseta.
    public function create()
    {
        $view = "views/productos/create.php";
        include_once 'views/main.php';
    }

    // Valida los datos recibidos y guarda la camiseta nueva.
    public function store()
    {
        $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
        $talla = isset($_POST['talla']) ? $_POST['talla'] : '';
        $precio = isset($_POST['precio']) ? $_POST['precio'] : '';

        if ($nombre === '' || !in_array($talla, self::TALLAS_VALIDAS, true) || !is_numeric($precio) || $precio < 0) {
            header('Location:?controller=producto&action=create');
            exit;
        }

        $producto = new Camiseta($nombre, $talla, (float) $precio);
        CamisetaDAO::store($producto);

        header('Location:?controller=producto');
        exit;
    }

    // Elimina la camiseta indicada por su identificador.
    public function destroy()
    {
        if (!isset($_GET['id']) || !ctype_digit((string) $_GET['id'])) {
            header('Location:?controller=producto');
            exit;
        }

        CamisetaDAO::destroy((int) $_GET['id']);
        header('Location:?controller=producto');
        exit;
    }

    // Busca una camiseta y muestra su ficha si existe.
    public function show()
    {
        if (!isset($_GET['id']) || !ctype_digit((string) $_GET['id'])) {
            header('Location:?controller=producto');
            exit;
        }

        $producto = CamisetaDAO::getById((int) $_GET['id']);
        if ($producto === null) {
            header('Location:?controller=producto');
            exit;
        }

        $view = "views/productos/show.php";
        include_once 'views/main.php';
    }
}

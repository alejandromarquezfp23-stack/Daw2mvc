
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appletito - Producto</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/Daw2mvc/css/detalleproducto.css">
    <link rel="icon" type="image/png" href="/Daw2mvc/iconos/LogoOscuro.png">
</head>

<body>

    <?php
        include __DIR__ . '/header3.php';

        require_once __DIR__ . '/../config/DataBase.php';
        require_once __DIR__ . '/../models/productos.php';
        require_once __DIR__ . '/../dao/productosDAO.php';

        $productosDAO = new productosDAO(DataBase::connect());
        $productos = $productosDAO->selectAll();
    ?>

    <div class="d-block divTituloP">
        <h1 class="tituloh1 fw-bold">Nombre Producto</h1>
        <p class="fw-semibold">Desde el precio€</p>
    </div>

    <div class="divProducto m-5 d-flex">
        <div class="d-flex justify-content-center align-items-center w-50 m-5 divImagen"
             style="height: 400px;">

            <img
                src="/Daw2mvc/imagenes/Hamburguesa gourmet con queso fundido y cebolla caramelizada.png"
                alt="Hamburguesa gourmet"
                class="w-25"
            >

        </div>

        <div class="d-block justify-content-center align-items-center divElementos">
            <h2 class="fw-semibold">
                Nombre.
                <span class="text-secondary fw-semibold">
                    ¿Como lo prefieres?
                </span>
            </h2>

            <div class="border border-black rounded-3 p-4 mb-5 mt-5">
                <h5 class="fw-bold">Con patatas</h5>
            </div>

            <div class="border border-black rounded-3 p-4 mb-5">
                <h5 class="fw-bold">Sin patatas</h5>
            </div>
        </div>
    </div>

    <div class="container-fluid bg-light p-5">
        <div class="row align-items-center g-5 m-5">
            <div class="col-12 col-md-4">
                <h2 class="fw-bold mb-5">
                    Nombre del producto
                </h2>
                <img
                    src="/Daw2mvc/imagenes/Hamburguesa gourmet con queso fundido y cebolla caramelizada.png"
                    alt="Hamburguesa gourmet"
                    class="img-fluid w-50"
                >
            </div>

            <div class="col-12 col-md-5">
                <h3 class="fs-5 fw-semibold mb-4">
                    Desde precio€
                </h3>
                <hr>
                <h4 class="fs-6 fw-semibold">
                    ¿Necesitas un momento?
                </h4>
                <p class="small text-secondary my-3">
                    Conserva todas tus selecciones guardando este dispositivo
                    en Tus favoritos. Después, podrás volver cuando quieras
                    y retomar todo donde lo dejaste.
                </p>
                <button class="btn btn-primary btn-sm rounded-3">
                    Guardar en favoritos
                </button>
                <hr class="my-4">
                <p class="small text-secondary mb-0">
                    Tu información de ticket aparecerá en tu correo electrónico.
                </p>
            </div>

            <div class="col-12 col-md-3">
                <button class="btn btn-primary rounded-3 w-100">
                    Continuar
                </button>
            </div>
        </div>
    </div>

    <?php
        include __DIR__ . '/footer.php';
    ?>
</body>
</html>

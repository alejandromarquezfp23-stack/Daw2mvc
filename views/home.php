<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appletito - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/Daw2mvc/css/home.css?v=3">
    <link rel="icon" type="image/png" href="/Daw2mvc/iconos/LogoOscuro.png">
</head>
<body>
    <?php
        include __DIR__ . '/header2.php';
    ?>
    <div class="container-fluid mt-1 text-white banner">
        <h1 class="text-center fw-bold titulos-h1">Appletito</h1>
        <h3 class="text-center">Disfruta de la mejor comida</h3>
        <p class="text-center text-secondary">Explora nuestro menú y disfruta de una experiencia culinaria única.</p>
        <div class="d-flex justify-content-center gap-3 mt-4">
            <a href="" class="btn btn-primary rounded-pill px-4">Más información</a>
            <a href="" class="btn btn-outline-primary rounded-pill px-4">Comprar</a>
        </div>
        <img src="/Daw2mvc/imagenes/Hamburguesa gourmet con queso fundido y cebolla caramelizada.png" alt="Imagen del restaurante" class="img-fluid mx-auto w-25 d-block mt-4">
    </div>

    <div class="container-fluid mt-1  banner2">
        <h1 class="text-center fw-bold titulos-h1">Disfruta de nuestra carne estrella</h1>
        <h3 class="text-center">Wagyu A5</h3>
        <p class="text-center text-secondary">Carne de alta calidad con un sabor excepcional.</p>
        <div class="d-flex justify-content-center gap-3 mt-4">
            <a href="" class="btn btn-primary rounded-pill px-4">Más información</a>
            <a href="" class="btn btn-outline-primary rounded-pill px-4">Comprar</a>
        </div>
        <img src="/Daw2mvc/imagenes/Wagyu A5.png" alt="Imagen del restaurante" class="img-fluid mx-auto w-25 d-block mt-4">
    </div>

    <div class="container-fluid mt-1  banner3">
        <h1 class="text-center fw-bold titulos-h1">Otros de nuestros exitos</h1>
        <h3 class="text-center">Salmón Gourmet</h3>
        <p class="text-center text-secondary">Salmón gourment con verduras y microbrotes.</p>
        <div class="d-flex justify-content-center gap-3 mt-4">
            <a href="" class="btn btn-primary rounded-pill px-4">Más información</a>
            <a href="" class="btn btn-outline-primary rounded-pill px-4">Comprar</a>
        </div>
        <img src="/Daw2mvc/imagenes/Salmón_gourmet_con_verduras_y_microbrotes-removebg-preview.png" alt="Imagen del restaurante" class="img-fluid mx-auto w-25 d-block mt-4">
    </div>

    <div class="container-fluid d-flex justify-content-center gap-3 mt-3 text-white">
        <div class="contenedores2 container-fluid mb-3 p-5">
            <h2 class="text-center fw-bold titulos-h1">Filete Pro</h2>
            <h5 class="text-center">Mucho Pro</h5>
            <div class="d-flex justify-content-center gap-3 mt-4">
                <a href="" class="btn btn-primary rounded-pill px-3">Más información</a>
                <a href="" class="btn btn-outline-primary rounded-pill px-3">Comprar</a>
            </div>
            <img src="/Daw2mvc/imagenes/Filete a la parrilla con guarnición de verduras.png" alt="Imagen del restaurante" class="img-fluid mx-auto w-50 d-block mt-4 rounded-2">
        </div>

        <div class="contenedores2 container-fluid mb-3 p-5">
            <h2 class="text-center fw-bold titulos-h1">Muy cremosa</h2>
            <h5 class="text-center">Pasta cremosa con gambas y perejil</h5>
            <div class="d-flex justify-content-center gap-3 mt-4">
                <a href="" class="btn btn-primary rounded-pill px-3">Más información</a>
                <a href="" class="btn btn-outline-primary rounded-pill px-3">Comprar</a>
            </div>
            <img src="/Daw2mvc/imagenes/Pasta cremosa con gambas y perejil.png" alt="Imagen del restaurante" class="img-fluid mx-auto w-50 d-block mt-4 rounded-2">
        </div>
    </div>

    <div class="container-fluid d-flex justify-content-center gap-3 mt-1">
        <div class="contenedores4 container-fluid mb-3 p-5">
            <h2 class="text-center fw-bold titulos-h1">Aurora te da alas</h2>
            <h5 class="text-center">El vino con mas calidad</h5>
            <div class="d-flex justify-content-center gap-3 mt-4">
                <a href="" class="btn btn-primary rounded-pill px-3">Más información</a>
                <a href="" class="btn btn-outline-primary rounded-pill px-3">Comprar</a>
            </div>
            <img src="/Daw2mvc/imagenes/Aurora.png" alt="Imagen del restaurante" class="img-fluid mx-auto w-100 d-block mt-4 rounded-2">
        </div>

        <div class="contenedores3 container-fluid mb-3 p-5">
            <h2 class="text-center fw-bold titulos-h1">Appletito</h2>
            <h5 class="text-center">Disfruta de la mejor comida</h5>
            <div class="d-flex justify-content-center gap-3 mt-4">
                <a href="" class="btn btn-primary rounded-pill px-3">Más información</a>
                <a href="" class="btn btn-outline-primary rounded-pill px-3">Comprar</a>
            </div>
            <img src="/Daw2mvc/imagenes/Shushi.jpg" alt="Imagen del restaurante" class="img-fluid mx-auto w-50 d-block mt-4 rounded-2">
        </div>
    </div>
    
    <div class="align-items-center container-fluid mt-1  banner2">
        <img src="/Daw2mvc/imagenes/BannerFinal.jpg" alt="Imagen del restaurante" class="img-fluid mx-auto w-75 d-block  rounded-3">
        <div class="d-flex justify-content-center gap-3 mt-4">
            <a href="" class="btn btn-primary rounded-pill px-4">Conoce más</a>
        </div>
    </div>

    <div id="footer">
        <?php
            include __DIR__ . '/footer.php';
        ?>
    </div>
</body>
</html>
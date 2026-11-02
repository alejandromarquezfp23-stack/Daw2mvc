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
        <h3 class="text-center">Disfruta de la mejor comida del mundo</h3>
        <p class="text-center text-secondary"><?php echo $productosMasPedidos[0]['nombre'] . ' - ' . 'Lo mas pedido de nosotros' ?></p>
        <div class="d-flex justify-content-center gap-3 mt-4">
            <a href="" class="btn btn-primary rounded-pill px-4">Más información</a>
            <a href="" class="btn btn-outline-primary rounded-pill px-4">Comprar</a>
        </div>
        <img src="<?php echo $productosMasPedidos[0]['imagen'] ?>" alt="Imagen del restaurante" class="img-fluid mx-auto d-block mt-4 w-25">
    </div>

    <div class="container-fluid mt-1  banner2">
        <h1 class="text-center fw-bold titulos-h1">Nuestra mejor tapa</h1>
        <h3 class="text-center"><?php echo $productosMasPedidos[1]['nombre'] ?></h3>
        <p class="text-center text-secondary"><?php echo $productosMasPedidos[1]['descripcion'] ?></p>
        <div class="d-flex justify-content-center gap-3 mt-4">
            <a href="" class="btn btn-primary rounded-pill px-4">Más información</a>
            <a href="" class="btn btn-outline-primary rounded-pill px-4">Comprar</a>
        </div>
        <img src="<?php echo $productosMasPedidos[1]['imagen'] ?>" alt="Imagen del restaurante" class="img-fluid mx-auto w-25 d-block mt-4">
    </div>

    <div class="container-fluid mt-1  banner3">
        <h1 class="text-center fw-bold titulos-h1">Otros de nuestros exitos</h1>
        <h3 class="text-center"><?php echo $productosMasPedidos[2]['nombre'] ?></h3>
        <p class="text-center text-secondary"><?php echo $productosMasPedidos[2]['descripcion'] ?></p>
        <div class="d-flex justify-content-center gap-3 mt-4">
            <a href="" class="btn btn-primary rounded-pill px-4">Más información</a>
            <a href="" class="btn btn-outline-primary rounded-pill px-4">Comprar</a>
        </div>
        <img src="<?php echo $productosMasPedidos[2]['imagen'] ?>" alt="Imagen del restaurante" class="img-fluid mx-auto w-25 d-block mt-4">
    </div>

    <div class="container-fluid d-flex flex-column flex-md-row justify-content-center gap-3 mt-3 text-white">
        <div class="contenedores2 container-fluid mb-3 p-5 rounded-3">
            <h2 class="text-center fw-bold titulos-h1"><?php echo $productosMasPedidos[3]['nombre'] ?></h2>
            <p class="text-center"><?php echo $productosMasPedidos[3]['descripcion'] ?></p>
            <div class="d-flex justify-content-center gap-3 mt-4">
                <a href="" class="btn btn-primary rounded-pill px-3">Más información</a>
                <a href="" class="btn btn-outline-primary rounded-pill px-3">Comprar</a>
            </div>
            <img src="<?php echo $productosMasPedidos[3]['imagen'] ?>" alt="Imagen del restaurante" class="img-fluid mx-auto w-50 d-block mt-4 rounded-2">
        </div>

        <div class="contenedores2 container-fluid mb-3 p-5 rounded-3">
            <h2 class="text-center fw-bold titulos-h1"><?php echo $productosMasPedidos[4]['nombre'] ?></h2>
            <p class="text-center"><?php echo $productosMasPedidos[4]['descripcion'] ?></p>
            <div class="d-flex justify-content-center gap-3 mt-4">
                <a href="" class="btn btn-primary rounded-pill px-3">Más información</a>
                <a href="" class="btn btn-outline-primary rounded-pill px-3">Comprar</a>
            </div>
            <img src="<?php echo $productosMasPedidos[4]['imagen'] ?>" alt="Imagen del restaurante" class="img-fluid mx-auto w-50 d-block mt-4 rounded-2">
        </div>
    </div>

    <div class="container-fluid d-flex flex-column flex-md-row justify-content-center gap-3 mt-1">
        <div class="contenedores4 container-fluid mb-3 p-5 rounded-3">
            <h2 class="text-center fw-bold titulos-h1"><?php echo $productosMasPedidos[5]['nombre'] ?></h2>
            <p class="text-center"><?php echo $productosMasPedidos[5]['descripcion'] ?></p>
            <div class="d-flex justify-content-center gap-3 mt-4">
                <a href="" class="btn btn-primary rounded-pill px-3">Más información</a>
                <a href="" class="btn btn-outline-primary rounded-pill px-3">Comprar</a>
            </div>
            <img src="<?php echo $productosMasPedidos[5]['imagen'] ?>" alt="Imagen del restaurante" class="img-fluid mx-auto w-50 d-block mt-4 rounded-2">
        </div>

        <div class="contenedores3 container-fluid mb-3 p-5 rounded-3">
            <h2 class="text-center fw-bold titulos-h1"><?php echo $productosMasPedidos[6]['nombre'] ?></h2>
            <p class="text-center"><?php echo $productosMasPedidos[6]['descripcion'] ?></p>
            <div class="d-flex justify-content-center gap-3 mt-4">
                <a href="" class="btn btn-primary rounded-pill px-3">Más información</a>
                <a href="" class="btn btn-outline-primary rounded-pill px-3">Comprar</a>
            </div>
            <img src="<?php echo $productosMasPedidos[6]['imagen'] ?>" alt="Imagen del restaurante" class="img-fluid mx-auto w-50 d-block mt-4 rounded-2">
        </div>
    </div>
    
    <div class="align-items-center container-fluid mt-1  banner2">
        <img src="/Daw2mvc/imagenes/otros/BannerFinal.jpg" alt="Imagen del restaurante" class="img-fluid mx-auto w-75 d-block  rounded-3">
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
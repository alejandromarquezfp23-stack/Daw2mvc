<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appletito - Carta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/Daw2mvc/css/carta.css">
    <link rel="icon" type="image/png" href="/Daw2mvc/iconos/LogoOscuro.png">
</head>
<body>
    <?php
        include __DIR__ . '/header.php';
    ?>

    <div class="mt-1 container-fluid div-carta">
        <div class="d-flex justify-content-between mx-5">
            <h1 class="text-center fw-bold mx-5 mt-5 mb-5 display-2">Carta</h1>
            <h2 class="text-end fw-bold mx-5 mt-5 mb-5 h2-primero">La mejor forma de elegir tus platos</h2>
        </div>
        
        <div class="d-flex justify-content-center mx-5 mb-5 mt-3">
            <?php
                require_once __DIR__ . '/../config/DataBase.php';
                $con = DataBase::connect();
                $stm = $con->prepare("SELECT * FROM categorias");
                $stm->execute();
                $resultado = $stm->get_result();
                $categorias = $resultado->fetch_all(MYSQLI_ASSOC);
            ?>

            <?php foreach ($categorias as $categoria) { ?>
                <div class="text-center">
                    <img src="<?= $categoria['imagenes'] ?>" alt="Logo de Appletito" class="card-logo w-50">
                    <p class="fw-bold"><?= $categoria['nombre'] ?></p>
                </div>
            <?php } ?>
        </div>
    </div>

    <div class="footer">
        <?php
            include __DIR__ . '/footer.php';
        ?>
    </div>
</body>
</html>
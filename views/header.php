<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appletito</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/Daw2mvc/css/header.css?v=4">
    <link rel="icon" type="image/png" href="/Daw2mvc/iconos/LogoOscuro.png">
</head>
<body class="body-carta">
    <header class="header-apple header-carta sticky-top">
        <nav class="navbar navbar-expand-md custom-navbar">
            <div class="container-fluid max-w-apple">
                
                <a class="navbar-brand me-0" href="/Daw2mvc/index.php?controller=home">
                    <img src="/Daw2mvc/iconos/Logo.svg" alt="Appletito Logo" width="25" height="25" class="object-fit-contain d-block">
                </a>

                <button class="navbar-toggler shadow-none border-0" type="button" data-bs-toggle="collapse" data-bs-target="#menuNavegacion" aria-controls="menuNavegacion" aria-expanded="false" aria-label="Abrir menú">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="menuNavegacion">
                    <ul class="navbar-nav mx-auto mb-2 mb-md-0 text-center gap-md-4">
                        <li class="nav-item"><a class="nav-link text-dark" href="/Daw2mvc/index.php?controller=home">Restaurante</a></li>
                        <li class="nav-item"><a class="nav-link text-dark" href="/Daw2mvc/index.php?controller=carta">Carta de la casa</a></li>
                        <li class="nav-item"><a class="nav-link text-dark" href="/Daw2mvc/index.php?controller=home">Soporte</a></li>
                    </ul>

                    <div class="d-flex justify-content-center align-items-center gap-4 py-2 py-md-0">
                        <a href="#" aria-label="Buscar" class="icono-link">
                            <img src="/Daw2mvc/iconos/LupaClara.svg" alt="Buscar" width="20" height="20" class="object-fit-contain">
                        </a>
                        <a href="#" aria-label="Bolsas" class="icono-link">
                            <img src="/Daw2mvc/iconos/BolsaClara.svg" alt="Bolsa" width="20" height="20" class="object-fit-contain">
                        </a>
                    </div>
                </div>

            </div>
        </nav>
    </header>

    <div class="barra-promocion barra-promocion-carta text-center py-3 px-3">
        <p class="m-0 mx-auto">Oportunidad para llevarte una tarjeta de regalo de nuestro restaurante de hasta 120€, por tener menos de 25 años y ser estudiante. Hasta el 22/11.</p>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
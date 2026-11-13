<form action="/Daw2mvc/index.php?controller=usuario&amp;action=store" method="POST" class="container-fluid px-3 px-md-5 py-4 py-md-5">
    <h1 class="fw-semibold text-center text-md-start px-md-5 mx-md-5">Crea tu cuenta en Appletito.</h1>

    <div class="d-flex flex-column align-items-center text-center mt-4 mt-md-5 p-3">
        <h2 class="fw-semibold mb-4 mb-md-5 fs-4">Regístrate</h2>

        <div class="row justify-content-center w-100">
            <div class="col-12 col-md-8 col-lg-6">
                <input type="text" name="nombre" placeholder="Nombre completo..." autocomplete="name" required class="form-control shadow-none py-2 mb-3">

                <input type="email" name="email" placeholder="Correo electrónico..." autocomplete="email" required class="form-control shadow-none py-2 mb-3">

                <input type="password" name="password" placeholder="Contraseña..." autocomplete="new-password" required class="form-control shadow-none py-2 mb-3">

                <input type="tel" name="telefono" placeholder="Teléfono..." autocomplete="tel" class="form-control shadow-none py-2 mb-3">

                <input type="text" name="direccion" placeholder="Dirección..." autocomplete="street-address" class="form-control shadow-none py-2 mb-3">

                <input type="date" name="fecha_nacimiento" aria-label="Fecha de nacimiento" class="form-control shadow-none py-2 mb-3">

                <div class="d-flex flex-column flex-sm-row gap-3">
                    <button type="submit" name="registro" class="btn btn-primary flex-fill py-2">Registrarse</button>
                </div>
            </div>
        </div>
    </div>
</form>
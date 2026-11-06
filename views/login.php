<form action="" method="POST" class="container-fluid px-3 px-md-5 py-4 py-md-5">
    <h1 class="fw-semibold text-center text-md-start px-md-5 mx-md-5">Inicia sesión para pagar más rápido.</h1>

    <div class="d-flex flex-column align-items-center text-center mt-4 mt-md-5 p-3">
        <h2 class="fw-semibold mb-4 mb-md-5 fs-4">Inicia sesión en Appletito</h2>

        <div class="row justify-content-center w-100">
            <div class="col-12 col-md-8 col-lg-6">
                <input type="text" placeholder="Usuario" class="form-control shadow-none py-2 mb-3">

                <input type="password" placeholder="Contraseña" class="form-control shadow-none py-2 mb-3">

                <div class="d-flex flex-column flex-sm-row gap-3">
                    <button id="botonLogin" class="btn botones flex-fill py-2">Continuar</button>
                    <a href="/Daw2mvc/index.php?controller=registro" class="btn botones flex-fill py-2">¿No tienes cuenta? Registrate</a>
                </div>
            </div>
        </div>

        <div class="form-check d-flex align-items-center gap-2 mt-4 mt-md-5">
            <input type="checkbox" id="recordarme">
            <label for="recordarme">Recordarme</label>
        </div>
    </div>
</form>
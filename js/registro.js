if (registroCorrecto === true) {
    Swal.fire({
        title: "¡Registro completado, inicia sesión!",
        text: "Tu cuenta se ha creado correctamente, ahora inicia sesión.",
        icon: "success",
        timer: 3000,
        timerProgressBar: true,
        showConfirmButton: false
    }).then(() => {
        window.location.href = "/Daw2mvc/index.php?controller=usuario&action=login";
    });
} else if (registroCorrecto === false) {
    Swal.fire({
        title: "No se pudo completar el registro",
        text: "El registro ha fallado, intentalo de nuevo.",
        icon: "error"
    });
}
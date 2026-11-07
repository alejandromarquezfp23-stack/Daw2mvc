if (registroCorrecto === true) {
    Swal.fire({
        title: "¡Registro completado!",
        text: "Tu cuenta se ha creado correctamente.",
        icon: "success",
        timer: 3000,
        showConfirmButton: false
    }).then(() => {
        window.location.href = "/Daw2mvc/index.php?controller=login";
    });
} else if (registroCorrecto === false) {
    Swal.fire({
        title: "No se pudo completar el registro",
        text: "Ya existe una cuenta registrada con ese correo electrónico.",
        icon: "error"
    });
}
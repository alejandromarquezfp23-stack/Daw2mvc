if (loginCorrecto === true) {
    Swal.fire({
        title: "¡Login correcto!",
        text: "Has iniciado sesión correctamente.",
        icon: "success",
        timer: 3000,
        timerProgressBar: true,
        showConfirmButton: false
    }).then(() => {
        window.location.href = "/Daw2mvc/index.php?controller=carrito";
    });
} else if (loginCorrecto === false) {
    Swal.fire({
        title: "¡Login incorrecto!",
        text: "El correo o la contraseña no son correctos.",
        icon: "error"
    });
}
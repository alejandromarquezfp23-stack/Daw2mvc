if (loginCorrecto) {
    Swal.fire({
        title: "Login correcto!",
        icon: "success",
        draggable: true,
        timer: 1500,
        showConfirmButton: false
    }).then(() => {
        window.location.href = "/Daw2mvc/index.php?controller=home";
    });
}
if (compraCorrecta === true && pedidoIdConfirmado) {
    Swal.fire({
        title: `¡Pedido #${pedidoIdConfirmado} realizado con éxito!`,
        text: "Tu pedido se ha confirmado correctamente.",
        icon: "success",
        timer: 3000,
        timerProgressBar: true,
        showConfirmButton: false
    });
}
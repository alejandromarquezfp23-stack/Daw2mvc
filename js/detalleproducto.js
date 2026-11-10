const aIngredientes = document.querySelectorAll('.aIngrediente');
const tarjetas = document.querySelectorAll('.tarjeta-ingrediente');
const precios = document.querySelectorAll('.precio-total');
const precioBase = Number(precios[0].dataset.baseCentimos);

function actualizarPrecio() {
    const ajuste = [...tarjetas].reduce((total, tarjeta) => {
        const precio = Number(tarjeta.dataset.precioCentimos);

        if (tarjeta.dataset.accion === 'anadir') {
            return total + precio;
        } else if (tarjeta.dataset.accion === 'quitar') {
             return total - precio;
        }
        
        return total;
    }, precioBase);

    const formato = new Intl.NumberFormat('es-ES', {minimumFractionDigits: 2, maximumFractionDigits: 2});

    precios.forEach(precio => {
        precio.textContent = formato.format(ajuste / 100);
    });
}

function actualizarSignoIngrediente(tarjeta, accion) {
    const precio = Number(tarjeta.dataset.precioCentimos);
    const formato = new Intl.NumberFormat('es-ES', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    });
    const etiquetaPrecio = tarjeta.querySelector('.precio-ajuste');
    const signo = accion === 'quitar' ? '−' : '+';

    etiquetaPrecio.textContent = `${signo}${formato.format(precio / 100)} €`;
}

aIngredientes.forEach(function(a) {
    a.addEventListener("click", function(e) {
        e.preventDefault();

        const tarjetaIngrediente = a.closest('.tarjeta-ingrediente');

        Swal.fire({
            title: "¿Qué quieres hacer?",
            text: "Puedes añadir o quitar este ingrediente.",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Añadir",
            cancelButtonText: "Quitar",
            confirmButtonColor: "#198754",
            cancelButtonColor: "#dc3545"
        }).then((result) => {
            if (result.isConfirmed) {
                tarjetaIngrediente.dataset.accion = 'anadir';
                actualizarSignoIngrediente(tarjetaIngrediente, 'anadir');
                document.querySelector(`[data-ingrediente-input="${tarjetaIngrediente.dataset.ingredienteId}"]`).value = tarjetaIngrediente.dataset.accion;

                tarjetaIngrediente.classList.add('ingrediente-anadido');
                tarjetaIngrediente.classList.remove('ingrediente-eliminado');

                actualizarPrecio();
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                tarjetaIngrediente.dataset.accion = 'quitar';
                actualizarSignoIngrediente(tarjetaIngrediente, 'quitar');
                document.querySelector(`[data-ingrediente-input="${tarjetaIngrediente.dataset.ingredienteId}"]`).value = tarjetaIngrediente.dataset.accion;

                tarjetaIngrediente.classList.remove('ingrediente-anadido');
                tarjetaIngrediente.classList.add('ingrediente-eliminado');

                actualizarPrecio();
            }
        });
    });
});

if (mensajeJS === 'Insertado') {
    Swal.fire({
        title: "¡Exito!",
        text: "Producto añadido a favoritos.",
        icon: "success",
        timer: 3000,
        showConfirmButton: false
    });
} else if (mensajeJS === 'Error') {
    Swal.fire({
        title: "¡No has iniciado sesion!",
        text: "Debes iniciar sesión para añadir favoritos..",
        icon: "error",
        timer: 3000,
        showConfirmButton: false
    });
} else if(mensajeJS === 'Eliminado') {
    Swal.fire({
        title: "¡Exito!",
        text: "Producto eliminado de favoritos.",
        icon: "success",
        timer: 3000,
        showConfirmButton: false
    });
}
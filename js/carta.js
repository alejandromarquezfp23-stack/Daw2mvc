function desplazarProductos(direccion) {
    const productos = document.querySelector('.divProductos');
    const inicio = productos.scrollLeft;
    const distancia = direccion * 350;
    const duracion = 700;
    let tiempoInicial = null;

    function animar(tiempoActual) {
        if (tiempoInicial === null) {
            tiempoInicial = tiempoActual;
        }

        let progreso = Math.min((tiempoActual - tiempoInicial) / duracion, 1);
        let suavizado = 1 - Math.pow(1 - progreso, 4);

        productos.scrollLeft = inicio + (distancia * suavizado);

        if (progreso < 1) {
            requestAnimationFrame(animar);
        }
    }

    requestAnimationFrame(animar);
}

const productos = document.querySelector('.divProductos');
const izquierda = document.querySelector('.flecha-izquierda');
const derecha = document.querySelector('.flecha-derecha');

function actualizarFlechas() {

    izquierda.style.display = productos.scrollLeft <= 0 ? 'none' : 'flex';

    derecha.style.display =
        productos.scrollLeft + productos.clientWidth >= productos.scrollWidth - 1
        ? 'none'
        : 'flex';
}

productos.addEventListener('scroll', actualizarFlechas);
window.addEventListener('resize', actualizarFlechas);
actualizarFlechas();
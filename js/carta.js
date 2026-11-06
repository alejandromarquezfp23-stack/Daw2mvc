let animacionActual = null;

function actualizarFlechas() {
    const productos = document.querySelector('.divProductos');
    const flechaIzquierda = document.querySelector('.flecha-izquierda');
    const flechaDerecha = document.querySelector('.flecha-derecha');
    const distanciaMaxima = productos.scrollWidth - productos.clientWidth;

    flechaIzquierda.classList.toggle('flecha-oculta', distanciaMaxima <= 0 || productos.scrollLeft <= 0);
    flechaDerecha.classList.toggle('flecha-oculta', distanciaMaxima <= 0 || productos.scrollLeft >= distanciaMaxima - 1);
}

function inicializarCarrusel() {
    const productos = document.querySelector('.divProductos');

    productos.addEventListener('scroll', actualizarFlechas);
    window.addEventListener('resize', actualizarFlechas);
    actualizarFlechas();
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', inicializarCarrusel);
} else {
    inicializarCarrusel();
}

function desplazarProductos(direccion) {
    const productos = document.querySelector('.divProductos');
    const inicio = productos.scrollLeft;
    const distanciaMaxima = productos.scrollWidth - productos.clientWidth;
    const destino = Math.max(0, Math.min(inicio + direccion * 350, distanciaMaxima));
    const duracion = 700;
    let tiempoInicial = null;

    if (animacionActual !== null) {
        cancelAnimationFrame(animacionActual);
    }

    function animar(tiempoActual) {
        if (tiempoInicial === null) {
            tiempoInicial = tiempoActual;
        }

        let progreso = Math.min((tiempoActual - tiempoInicial) / duracion, 1);
        let suavizado = 1 - Math.pow(1 - progreso, 4);

        productos.scrollLeft = inicio + (destino - inicio) * suavizado;

        if (progreso < 1) {
            animacionActual = requestAnimationFrame(animar);
        } else {
            animacionActual = null;
        }
    }

    animacionActual = requestAnimationFrame(animar);
}
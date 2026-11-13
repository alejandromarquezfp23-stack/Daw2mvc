<div class="container py-5 text-center">
    <h1 class="fw-semibold mb-3">¡Gracias por tu pedido!</h1>
    <p class="text-secondary mb-2">Tu número de pedido es:</p>
    <p class="display-6 fw-bold">#<?= (int) $pedidoID ?></p>
    <a class="btn btn-dark rounded-3 mt-3"
       href="index.php?controller=usuario&amp;action=show&amp;historial_pedidos=1">
        Ver mis pedidos
    </a>
</div>
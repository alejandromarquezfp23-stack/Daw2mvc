document.addEventListener('DOMContentLoaded', function () {
    const buttons = document.querySelectorAll('[data-table-target]');
    const panels = document.querySelectorAll('[data-table-panel]');

    buttons.forEach(function (button) {
        button.addEventListener('click', function () {
            const target = button.dataset.tableTarget;

            panels.forEach(function (panel) {
                panel.hidden = panel.id !== 'tabla-' + target;
            });

            buttons.forEach(function (item) {
                const isActive = item === button;
                item.classList.toggle('btn-dark', isActive);
                item.classList.toggle('btn-outline-dark', !isActive);
                item.setAttribute('aria-pressed', String(isActive));
            });
        });
    });
});

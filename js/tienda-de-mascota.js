document.addEventListener('DOMContentLoaded', () => {
    const botonesComprar = document.querySelectorAll('.btn-comprar');

    botonesComprar.forEach((boton) => {
        boton.addEventListener('click', () => {
            const tarjeta = boton.closest('.producto');
            const producto = tarjeta ? tarjeta.querySelector('.producto-titulo').textContent.trim() : 'Mejora';

            mostrarNotificacion('¡Compra exitosa!', `Has adquirido: ${producto}`);
        });
    });
});

function mostrarNotificacion(titulo, mensaje) {
    const contenedor = document.getElementById('notificaciones');
    if (!contenedor) return;

    const toast = document.createElement('div');
    toast.className = 'toast-alerta';
    toast.innerHTML = `
        <div class="toast-icono">✓</div>
        <div class="toast-contenido">
            <strong>${titulo}</strong>
            <span>${mensaje}</span>
        </div>
    `;

    contenedor.appendChild(toast);

    // Animación de entrada
    requestAnimationFrame(() => {
        toast.classList.add('mostrar');
    });

    // Ocultar y remover después de 3.5 segundos
    setTimeout(() => {
        toast.classList.remove('mostrar');
        toast.addEventListener('transitionend', () => {
            toast.remove();
        });
    }, 3500);
}

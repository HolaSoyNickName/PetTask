document.addEventListener("DOMContentLoaded", () => {
    const botonVerMas = document.getElementById("btn-ver-mas");

    if (!botonVerMas) return;

    botonVerMas.addEventListener("click", () => {
        window.location.href = "ver-tareas.html";
    });
});

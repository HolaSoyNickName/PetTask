```javascript
document.addEventListener("DOMContentLoaded", function () {

    const boton = document.getElementById("btn-ver-mas");
    const tareasExtra = document.querySelectorAll(".tarea-extra");

    if (!boton) {
        alert("No se encontró el botón. Revisa el ID en el HTML.");
        return;
    }

    if (tareasExtra.length === 0) {
        alert("No se encontraron las tareas adicionales. Revisa la clase tarea-extra.");
        return;
    }

    let mostrarTodas = false;

    boton.addEventListener("click", function () {

        mostrarTodas = !mostrarTodas;

        tareasExtra.forEach(function (tarea) {
            tarea.style.display = mostrarTodas ? "flex" : "none";
        });

        boton.innerHTML = mostrarTodas
            ? 'Ver menos <i class="bi bi-chevron-up"></i>'
            : 'Ver más <i class="bi bi-chevron-down"></i>';

        boton.setAttribute("aria-expanded", mostrarTodas);

    });

});
```
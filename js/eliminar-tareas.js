const modalEliminacion = document.getElementById("confirmarEliminacion");
let formularioPendiente = null;

modalEliminacion.addEventListener("show.bs.modal", (event) => {
    formularioPendiente = null;
    const botonEliminar = event.relatedTarget;
    if (!(botonEliminar instanceof HTMLElement)) return;
    const tarea = botonEliminar.closest(".tarea-item");
    document.getElementById("materiaTareaModal").textContent =
        tarea?.querySelector(".tarea-titulo")?.textContent.trim() ?? "Tarea";
    document.getElementById("descripcionTareaModal").textContent =
        tarea?.querySelector(".tarea-descripcion")?.textContent.trim() ?? "";
    formularioPendiente = botonEliminar.closest("form");
});

document.getElementById("confirmarEliminar").addEventListener("click", () => {
    formularioPendiente?.requestSubmit();
});

modalEliminacion.addEventListener("hidden.bs.modal", () => {
    formularioPendiente = null;
});

const formularioFiltro = document.querySelector(".formulario-filtro");
const campoMateria = document.getElementById("filtroMateria");
const tareas = document.querySelectorAll(".tarea-item");

function filtrarTareas() {
    const materiaBuscada = campoMateria.value.trim().toLocaleLowerCase("es");
    tareas.forEach((tarea) => {
        const materia = tarea.querySelector(".tarea-titulo")?.textContent
            .trim()
            .toLocaleLowerCase("es") ?? "";
        tarea.hidden = !materia.includes(materiaBuscada);
    });
}

campoMateria.addEventListener("input", filtrarTareas);
formularioFiltro.addEventListener("submit", (event) => {
    event.preventDefault();
    filtrarTareas();
});

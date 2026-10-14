// getElementById: elementos únicos e identificables del DOM.
const listaTareas = document.getElementById("listaTareas");
const inputBusqueda = document.getElementById("inputBusqueda");
const estadoVacio = document.getElementById("estadoVacio");
const btnAgregarTarea = document.getElementById("btnAgregarTarea");

// querySelector: primer (y único) contenedor de filtros.
const grupoFiltros = document.querySelector(".grupo-filtros");

// querySelectorAll: colección de botones de filtro.
const botonesFiltro = document.querySelectorAll(".btn-filtro");

let filtroActual = "todas"; // 'todas' | 'pendiente' | 'completada'
let textoBusqueda = ""; // Texto ingresado por el usuario


function aplicarFiltroYBuscado() {
  const tareas = document.querySelectorAll(".tarea-item");
  const texto = textoBusqueda.toLowerCase().trim();
  let visibles = 0;

  tareas.forEach(function (tarea) {
    const estado = tarea.dataset.estado;
    const contenido = tarea.textContent.toLowerCase();

    const coincideFiltro = filtroActual === "todas" || estado === filtroActual;
    const coincideBusqueda = texto === "" || contenido.includes(texto);

    const mostrar = coincideFiltro && coincideBusqueda;

    // classList.toggle con clase utilitaria de Bootstrap
    tarea.classList.toggle("d-none", !mostrar);

    if (mostrar) visibles++;
  });

  // Mostrar u ocultar el bloque de "estado vacío"
  if (visibles === 0) {
    estadoVacio.style.display = "flex";
  } else {
    estadoVacio.style.display = "none";
  }
}


function manejarClickFiltro(evento) {
  const boton = evento.target.closest(".btn-filtro");
  if (!boton) return;

  // Quitar la clase 'activo' de todos los botones
  botonesFiltro.forEach(function (b) {
    b.classList.remove("activo");
  });
  // Marcar el botón presionado como activo
  boton.classList.add("activo");

  // Actualizar filtro y refrescar la lista
  filtroActual = boton.dataset.filtro;
  aplicarFiltroYBuscado();
}


function manejarBusqueda() {
  textoBusqueda = inputBusqueda.value;
  aplicarFiltroYBuscado();
}


function manejarClickAgregar() {
  console.log("Botón 'Agregar nueva tarea' presionado");
}

// Delegación: un solo listener para todos los botones de filtro.
grupoFiltros.addEventListener("click", manejarClickFiltro);

// Búsqueda en tiempo real (input).
inputBusqueda.addEventListener("input", manejarBusqueda);

// Botón "Agregar nueva tarea".
btnAgregarTarea.addEventListener("click", manejarClickAgregar);

// Aplica el filtro/búsqueda inicial al cargar la página.
aplicarFiltroYBuscado();
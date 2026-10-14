// Modo oscuro con localStorage. Evento: click. Componente Bootstrap: data-bs-theme + Bootstrap Icons. Selectores: getElementById.
const CLAVE_TEMA = "pettask-tema";
const CLASE_ICONO_SOL = "bi-sun-fill";
const CLASE_ICONO_LUNA = "bi-moon-stars-fill";

// Aplica el tema (claro u oscuro) al body y actualiza el icono.
function aplicarTema(tema) {
    document.body.setAttribute("data-bs-theme", tema);

    const icono = document.getElementById("iconoTema");
    const boton = document.getElementById("btnTema");

    if (icono) {
        if (tema === "dark") {
            icono.classList.remove(CLASE_ICONO_SOL);
            icono.classList.add(CLASE_ICONO_LUNA);
        } else {
            icono.classList.remove(CLASE_ICONO_LUNA);
            icono.classList.add(CLASE_ICONO_SOL);
        }
    }

    if (boton) {
        boton.setAttribute("aria-label", tema === "dark" ? "Cambiar a modo claro" : "Cambiar a modo oscuro");
    }
}

// Alterna entre modo claro y oscuro, y guarda la preferencia.
function alternarTema() {
    const temaActual = document.body.getAttribute("data-bs-theme") || "light";
    const nuevoTema = temaActual === "dark" ? "light" : "dark";

    aplicarTema(nuevoTema);

    try {
        localStorage.setItem(CLAVE_TEMA, nuevoTema);
    } catch (error) {
        console.warn("No se pudo guardar la preferencia de tema:", error);
    }
}

// Carga el tema guardado en localStorage al iniciar la pagina.
function cargarTemaGuardado() {
    let temaGuardado = "light";

    try {
        temaGuardado = localStorage.getItem(CLAVE_TEMA) || "light";
    } catch (error) {
        console.warn("No se pudo leer la preferencia de tema:", error);
    }

    aplicarTema(temaGuardado);
}

// Registro de eventos al cargar el DOM.
document.addEventListener("DOMContentLoaded", () => {
    cargarTemaGuardado();

    const boton = document.getElementById("btnTema");
    if (boton) {
        boton.addEventListener("click", alternarTema);
    }
});
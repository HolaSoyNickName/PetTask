(() => {
    const featureLinks = [
        ["Inicio", "../index.html"],
        ["Servicios", "../servicios.html"],
        ["Resumen", "carga-de-datos-general.html"],
        ["Tareas", "ver-tareas.html"],
        ["Agregar", "agregar-tareas.html"],
        ["Mascota", "interaccion-con-mascota.html"]
    ];

    function addFeaturePageNavigation() {
        if (!window.location.pathname.toLowerCase().includes("/html/")) {
            return;
        }

        const header = document.createElement("header");
        header.className = "pet-nav";

        const brand = document.createElement("a");
        brand.className = "pet-nav__brand";
        brand.href = "../index.html";
        brand.textContent = "PetTask";
        header.append(brand);

        const nav = document.createElement("nav");
        nav.className = "pet-nav__links";
        nav.setAttribute("aria-label", "Navegación principal");
        for (const [label, href] of featureLinks) {
            const link = document.createElement("a");
            link.href = href.includes("../") ? href : `./${href}`;
            link.textContent = label;
            nav.append(link);
        }
        header.append(nav);
        document.body.prepend(header);
    }

    function updateTaskCounters() {
        const items = [...document.querySelectorAll("#listaTareas .tarea-item")];
        const pending = items.filter((item) => item.dataset.estado === "pendiente").length;
        const completed = items.length - pending;
        const values = {
            "cnt-total": items.length,
            "cnt-pendientes": pending,
            "cnt-completadas": completed
        };

        for (const [id, value] of Object.entries(values)) {
            const element = document.getElementById(id);
            if (element) element.textContent = String(value);
        }

        return items;
    }

    function refreshTaskList() {
        const items = updateTaskCounters();
        const query = (document.getElementById("inputBusqueda")?.value || "").trim().toLocaleLowerCase();
        const activeFilter = document.querySelector(".btn-filtro.activo")?.dataset.filter || "todas";
        let visibleCount = 0;

        for (const item of items) {
            const matchesFilter = activeFilter === "todas" || item.dataset.estado === activeFilter;
            const matchesSearch = item.textContent.toLocaleLowerCase().includes(query);
            item.hidden = !(matchesFilter && matchesSearch);
            if (!item.hidden) visibleCount += 1;
        }

        const emptyState = document.getElementById("estadoVacio");
        if (emptyState) emptyState.style.display = visibleCount ? "none" : "flex";
    }

    window.filtrarTareas = (filter, button) => {
        document.querySelectorAll(".btn-filtro").forEach((item) => {
            item.classList.toggle("activo", item === button);
            item.dataset.filter = item === button ? filter : item.dataset.filter;
        });
        if (button) button.dataset.filter = filter;
        refreshTaskList();
    };

    window.buscarTarea = refreshTaskList;

    window.cambiarEstadoTarea = (button) => {
        const item = button.closest(".tarea-item");
        if (!item) return;

        const completed = item.dataset.estado !== "completada";
        item.dataset.estado = completed ? "completada" : "pendiente";
        item.classList.toggle("completada", completed);
        button.classList.toggle("btn-completar", !completed);
        button.classList.toggle("btn-deshacer", completed);
        button.textContent = completed ? "Deshacer" : "Marcar completada";
        refreshTaskList();
    };

    document.addEventListener("DOMContentLoaded", () => {
        addFeaturePageNavigation();
        refreshTaskList();

        const addTaskButton = document.querySelector(".btn-rosa");
        if (addTaskButton && addTaskButton.textContent.includes("Agregar nueva tarea")) {
            addTaskButton.addEventListener("click", () => {
                window.location.href = "agregar-tareas.html";
            });
        }
    });
})();

(() => {
    const featureLinks = [
        ["Inicio", "../index.html", "index.html"],
        ["Nosotros", "../nosotros.html", "nosotros.html"],
        ["Servicios", "../servicios.html", "servicios.html"],
        ["Contacto", "../contacto.html", "contacto.html"],
        ["Iniciar sesión", "iniciar-sesion.html", "iniciar-sesion.html", true]
    ];

    function addFeaturePageNavigation() {
        if (document.querySelector(".pet-nav")) {
            return;
        }

        const pathname = window.location.pathname.toLowerCase();
        const currentPage = pathname.split("/").pop();
        const pagesWithoutNavigation = ["iniciar-sesion.html", "registro.html"];

        if (!pathname.includes("/html/") || pagesWithoutNavigation.includes(currentPage)) {
            return;
        }

        const header = document.createElement("header");
        header.className = "pet-nav navbar navbar-expand-md navbar-dark";

        const brand = document.createElement("a");
        brand.className = "pet-nav__brand";
        brand.href = "../index.html";
        const brandIcon = document.createElement("img");
        brandIcon.src = "../img/logoNav.png";
        brandIcon.alt = "Logotipo de PetTask";
        brand.append(brandIcon);
        header.append(brand);

        const toggler = document.createElement("button");
        toggler.className = "navbar-toggler";
        toggler.type = "button";
        toggler.setAttribute("data-bs-toggle", "collapse");
        toggler.setAttribute("data-bs-target", "#menuPrincipal");
        toggler.setAttribute("aria-controls", "menuPrincipal");
        toggler.setAttribute("aria-expanded", "false");
        toggler.setAttribute("aria-label", "Abrir menú de navegación");
        const togglerIcon = document.createElement("span");
        togglerIcon.className = "navbar-toggler-icon";
        toggler.append(togglerIcon);
        header.append(toggler);

        const collapseDiv = document.createElement("div");
        collapseDiv.className = "collapse navbar-collapse";
        collapseDiv.id = "menuPrincipal";

        const nav = document.createElement("nav");
        nav.className = "pet-nav__links navbar-nav ms-lg-auto";
        nav.setAttribute("aria-label", "Navegación principal");
        for (const [label, href, page, isLogin] of featureLinks) {
            const link = document.createElement("a");
            link.href = href.startsWith("../") ? href : `./${href}`;
            link.textContent = label;
            if (isLogin) link.className = "pet-nav__login";
            if (currentPage === page) link.setAttribute("aria-current", "page");
            nav.append(link);
        }
        collapseDiv.append(nav);
        header.append(collapseDiv);
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

    function syncActivityStreak() {
        const storageKey = "pettask.rachaActividad";
        const currentValue = document.querySelector(".racha-valor");
        const completedTasks = document.querySelectorAll(".tareas-racha .tarea-racha.completada");
        const stats = [...document.querySelectorAll(".tarjeta-estadisticas .estadistica-valor")];
        const homeValue = document.getElementById("racha-actual-inicio");
        let streak;

        try {
            streak = JSON.parse(localStorage.getItem(storageKey) || "null");
        } catch {
            streak = null;
        }

        if (currentValue) {
            const current = completedTasks.length
                ? completedTasks.length
                : Number(currentValue.textContent.trim());
            const best = Number(stats[1]?.textContent.trim());
            streak = {
                current,
                best: Number.isFinite(streak?.best) ? streak.best : best
            };

            currentValue.textContent = String(streak.current);
            if (stats[0]) stats[0].textContent = String(streak.current);
            if (stats[1]) stats[1].textContent = String(streak.best);
            localStorage.setItem(storageKey, JSON.stringify(streak));
        }

        if (homeValue && Number.isFinite(streak?.current)) {
            homeValue.textContent = String(streak.current);
        }
    }

    function addFormRedirects() {
        document.querySelectorAll("form[data-redirect]").forEach((form) => {
            form.addEventListener("submit", (event) => {
                event.preventDefault();
                window.location.href = form.dataset.redirect;
            });
        });
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
        syncActivityStreak();
        addFormRedirects();
        refreshTaskList();

        const addTaskButton = document.querySelector(".btn-rosa");
        if (addTaskButton && addTaskButton.textContent.includes("Agregar nueva tarea")) {
            addTaskButton.addEventListener("click", () => {
                window.location.href = "agregar-tareas.html";
            });
        }
    });
})();

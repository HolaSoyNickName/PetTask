const boton = document.querySelector("#subir-nivel");
const barra = document.querySelector("#barra-progreso");
const progreso = document.querySelector(".barra-progreso");

let nivel = 5;
let xpUsuario = 50000;
let xpGatonto = 500;

function actualizarPantalla() {
  const faltan = 1000 - xpGatonto;

  document.querySelector("#nivel-mascota").textContent = `Nivel ${nivel}`;
  document.querySelector("#xp-usuario").textContent = `${xpUsuario} XP`;
  document.querySelector("#texto-progreso").textContent =
    `${xpGatonto} / 1000 XP de Gatonto`;
  document.querySelector("#texto-restantes").textContent =
    `Faltan ${faltan} XP para el siguiente nivel`;

  barra.style.width = `${xpGatonto / 10}%`;
  progreso.setAttribute("aria-valuenow", xpGatonto);
  boton.disabled = xpUsuario < 100;
}

boton.addEventListener("click", () => {
  xpUsuario -= 100;
  xpGatonto += 100;

  if (xpGatonto === 1000) {
    xpGatonto = 0;
    nivel++;
  }

  actualizarPantalla();
});

actualizarPantalla();

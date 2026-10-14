const boton = document.querySelector("#subir-nivel");
const barra = document.querySelector("#barra-progreso");
const progreso = document.querySelector(".barra-progreso");

let nivel = 5;
let xpUsuario = 50000;
let xpFirulais = 500;

function actualizarPantalla() {
  const faltan = 1000 - xpFirulais;

  document.querySelector("#nivel-mascota").textContent = `Nivel ${nivel}`;
  document.querySelector("#xp-usuario").textContent = `${xpUsuario} XP`;
  document.querySelector("#texto-progreso").textContent =
    `${xpFirulais} / 1000 XP de Firulais`;
  document.querySelector("#texto-restantes").textContent =
    `Faltan ${faltan} XP para el siguiente nivel`;

  barra.style.width = `${xpFirulais / 10}%`;
  progreso.setAttribute("aria-valuenow", xpFirulais);
  boton.disabled = xpUsuario < 100;
}

boton.addEventListener("click", () => {
  xpUsuario -= 100;
  xpFirulais += 100;

  if (xpFirulais === 1000) {
    xpFirulais = 0;
    nivel++;
  }

  actualizarPantalla();
});

actualizarPantalla();

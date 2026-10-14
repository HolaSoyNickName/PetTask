

document.addEventListener("DOMContentLoaded", () => {
   const configurarMostrarOcultar = (idInput, idBoton) => {
        const input = document.getElementById(idInput);
        const boton = document.getElementById(idBoton);
        const icono = boton.querySelector("i");

        boton.addEventListener("click", () => {
            if (input.type === "password") {
                input.type = "text";
                icono.classList.remove("bi-eye");
                icono.classList.add("bi-eye-slash");
            } else {
                input.type = "password"; 
                icono.classList.remove("bi-eye-slash"); 
                icono.classList.add("bi-eye");
            }
        });
    };
    configurarMostrarOcultar("contrasena", "toggle-contrasena");
    configurarMostrarOcultar("confirmar-contrasena", "toggle-confirmar");

    const formulario = document.getElementById("formulario-registro");
    const inputContrasena = document.getElementById("contrasena");
    const inputConfirmar = document.getElementById("confirmar-contrasena");
    const errorContrasena = document.getElementById("error-contrasena");
    const errorConfirmar = document.getElementById("error-confirmar");

    const limpiarError = (input, mensaje) => {
        mensaje.textContent = "";
        input.removeAttribute("aria-invalid");
    };
    inputContrasena.addEventListener("input", () => limpiarError(inputContrasena, errorContrasena));
    inputConfirmar.addEventListener("input", () => limpiarError(inputConfirmar, errorConfirmar));

    formulario.addEventListener("submit", (evento) => {
        evento.preventDefault();
        const contrasena = inputContrasena.value;
        const confirmar = inputConfirmar.value;

        limpiarError(inputContrasena, errorContrasena);
        limpiarError(inputConfirmar, errorConfirmar);
        if (contrasena.length < 8) {
            errorContrasena.textContent = "La contraseña debe tener al menos 8 caracteres.";
            inputContrasena.setAttribute("aria-invalid", "true");
            inputContrasena.focus();
            return;
        }

        if (contrasena !== confirmar) {
            errorConfirmar.textContent = "Las contraseñas no coinciden. Verifícalas e inténtalo de nuevo.";
            inputConfirmar.setAttribute("aria-invalid", "true");
            inputConfirmar.focus();
            return; 
        }

        alert("¡Cuenta creada exitosamente en PetTask!");
        formulario.reset();
        inputContrasena.type = "password";
        document.querySelector("#toggle-contrasena i").className = "bi bi-eye";
        inputConfirmar.type = "password";
        document.querySelector("#toggle-confirmar i").className = "bi bi-eye";
    });
});



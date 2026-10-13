'use strict';

(() => {
    const formulario = document.querySelector('#formulario-login');
    if (!formulario) return;

    const campos = Array.from(formulario.querySelectorAll('input[required]'));
    const estado = formulario.querySelector('#estado-login');
    let intentoDeEnvio = false;

    function mensajeDeError(campo) {
        if (campo.validity.valueMissing) return 'Completa este campo.';
        if (campo.validity.tooLong) return 'Usa como maximo ' + campo.maxLength + ' caracteres.';
        if (campo.id === 'contrasena' && campo.validity.tooShort) return 'La contrasena debe tener al menos 8 caracteres.';
        if (campo.id === 'contrasena' && campo.validity.patternMismatch) return 'Incluye al menos un simbolo especial (sin contar espacios).';
        if (campo.validity.typeMismatch) return 'Revisa el formato ingresado.';
        return 'Revisa este campo.';
    }

    function validarCampo(campo, mostrar = false) {
        const valido = campo.validity.valid;
        const error = formulario.querySelector(`#error-${campo.id}`);

        campo.classList.toggle('is-invalid', mostrar && !valido);
        campo.classList.toggle('is-valid', mostrar && valido);
        campo.setAttribute('aria-invalid', String(mostrar && !valido));
        if (error) error.textContent = valido ? '' : mensajeDeError(campo);
        return valido;
    }

    campos.forEach((campo) => {
        campo.addEventListener('input', () => {
            // No señalar errores antes de que el usuario haya intentado enviar
            // o haya salido del campo. Una corrección limpia el estado al instante.
            const mostrar = intentoDeEnvio || campo.dataset.tocado === 'true';
            validarCampo(campo, mostrar);
            if (estado) estado.textContent = '';
        });

        campo.addEventListener('blur', () => {
            campo.dataset.tocado = 'true';
            validarCampo(campo, true);
        });
    });

    formulario.addEventListener('submit', (evento) => {
        evento.preventDefault();
        intentoDeEnvio = true;

        campos.forEach((campo) => validarCampo(campo, true));
        const primerCampoInvalido = campos.find((campo) => !campo.validity.valid);
        if (primerCampoInvalido) {
            primerCampoInvalido.focus();
            if (estado) estado.textContent = 'Hay campos que necesitan correccion.';
            return;
        }

        // Preserve the prototype's original button behavior after validation.
        window.location.href = 'index.html';
    });
})();

export default class FormularioService {

    obtenerDatos(formularioId) {

        const formulario = document.getElementById(formularioId);
        const datos = {};

        formulario.querySelectorAll('[name]').forEach(campo => {

            let valor = campo.value;

            if (typeof valor === 'string') {
                valor = valor.trim();
            }

            datos[campo.name] = valor;

        });

        return datos;
    }

    onSubmit(idFormulario, callback) {

        const formulario = document.getElementById(idFormulario);
        if (!formulario) return;

        formulario.addEventListener('submit', (event) => {
            event.preventDefault();
            callback(event);
        });
    }

    onClick(idElemento, callback) {
        const elemento = document.getElementById(idElemento);
        if (!elemento) return;
        elemento.addEventListener('click', callback);
    }

    llenar(idFormulario, datos) {

        const formulario = document.getElementById(idFormulario);

        if (!formulario) return;

        Object.keys(datos).forEach(campo => {
            const input = formulario.querySelector(`[name="${campo}"]`);

            if (input) {
                input.value = datos[campo];
            }
        });
    }

    limpiar(idFormulario) {
        const formulario = document.getElementById(idFormulario);

        if (formulario) {
            formulario.reset();
        }
    }

    mostrarErroresCampos(errores) {
        Object.keys(errores).forEach(campo => {

            const elemento = document.getElementById(`error-${campo}`);

            if (elemento) {
                elemento.innerText = errores[campo][0];
            }
        });
    }

    inicializarEventosErrores(idFormulario) {

        const formulario = document.getElementById(idFormulario);

        if (!formulario) return;

        formulario.querySelectorAll('input, select, textarea').forEach(campo => {

            campo.addEventListener('input', () => {

                const error = formulario.querySelector(`#error-${campo.name}`);

                if (error) {
                    error.innerText = '';
                }

            });

        });

    }

    limpiarErroresCampos(idFormulario) {

        const formulario = document.getElementById(idFormulario);

        if (!formulario) return;

        formulario.querySelectorAll("[id^='error-']").forEach(error => {

            error.innerText = '';

        });
    }

    reiniciar(idFormulario) {
        this.limpiar(idFormulario);
        this.limpiarErroresCampos(idFormulario);
    }
}
export default class FormularioService {

    obtenerDatos(formularioId) {

        let formulario = document.getElementById(formularioId);
        let datos = {};

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

        let formulario = document.getElementById(idFormulario);

        if (!formulario) return;
        if (formulario._submitCallback) {
            formulario.removeEventListener(  'submit',  formulario._submitCallback);
        }

        formulario._submitCallback = (event) => {
            event.preventDefault();

            callback(event);
        };

        formulario.addEventListener(
            'submit',
            formulario._submitCallback
        );
    }

    onClick(idElemento, callback) {
        let elemento = document.getElementById(idElemento);
        if (!elemento) return;
        elemento.addEventListener('click', callback);
    }


    llenar(idFormulario, datos) {

        let formulario = document.getElementById(idFormulario);

        if (!formulario) return;

        Object.keys(datos).forEach(campo => {
            let input = formulario.querySelector(`[name="${campo}"]`);

            if (input) {
                input.value = datos[campo];
            }
        });
    }

    limpiar(idFormulario) {
        let formulario = document.getElementById(idFormulario);

        if (formulario) {
            formulario.reset();
        }
    }

    mostrarErroresCampos(errores) {
        Object.keys(errores).forEach(campo => {

            let elemento = document.getElementById(`error-${campo}`);

            if (elemento) {
                elemento.innerText = errores[campo][0];
            }
        });
    }

    inicializarEventosErrores(idFormulario) {

        let formulario = document.getElementById(idFormulario);

        if (!formulario) return;

        formulario.querySelectorAll('input, select, textarea').forEach(campo => {

            campo.addEventListener('input', () => {

                let error = formulario.querySelector(`#error-${campo.name}`);

                if (error) {
                    error.innerText = '';
                }

            });

        });

    }

    limpiarErroresCampos(idFormulario) {

        let formulario = document.getElementById(idFormulario);

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
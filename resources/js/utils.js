
class PeticionService {

    constructor() { }

    async request(ruta, { method = 'POST', data = {},  loader = true } = {}) {

        let formData = new FormData();

        // CSRF siempre
        let csrf = document.querySelector('input[name="_token"]')?.value;
        if (csrf) formData.append('_token', csrf);

        // convertir objeto o FormData
        if (data instanceof FormData) {
            for (let [key, value] of data.entries()) {   
                formData.append(key, value);
            }
        } else {

            for (let key in data) {
                formData.append(key, data[key]);
            }
        }

        // if (loader) openLoader();

        return fetch(ruta, {
            method: method,
            body: formData
        }).then(response => response.json()).then(data => {

            return data;

        }).catch(function (err) {
            return null;

        }).finally(function () {
            // if (loader) closeLoader();
        });
    }

}
window.App = window.App || {};
App.peticionService = new PeticionService();

App.limpiarErroresFormulario = function (form) {

    form.querySelectorAll('[id^="error-"]').forEach(error => {
        error.textContent = '';
    });

}
// window.closeLoader = window.closeLoader || function () {};
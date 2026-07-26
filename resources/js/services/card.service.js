export default class CardService {

    actualizar(datos = {}) {

        Object.entries(datos).forEach(([id, valor]) => {

            const elemento = document.getElementById(id);

            if (!elemento) return;

            elemento.textContent = valor;

        });

    }

}
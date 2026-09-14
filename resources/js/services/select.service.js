import TomSelect from 'tom-select';
import { createIcons, icons } from 'lucide';
import 'tom-select/dist/css/tom-select.css';

export default class SelectService {

    iniciar(selector = '.select') {

        document.querySelectorAll(selector).forEach(element => {

            if (element.tomselect) return;
            let tomSelect = new TomSelect(element, {
                create: false,
                allowEmptyOption: true,
                placeholder: 'Seleccione una opción',

                render: {
                    no_results: function (data, escape) {
                        return `<div class="no-results">No se encontraron resultados</div>`;
                    }
                }
            });

            let icono = element.dataset.icon;

            if (icono) {
                tomSelect.control.classList.add('con-icon');
                tomSelect.control.insertAdjacentHTML(
                    'afterbegin',
                    `<i data-lucide="${icono}" class="select-icon absolute left-2 top-1/2 -translate-y-1/2 tam-lucide-select  text-slate-400"></i>`
                );

                createIcons({ icons });
            }
        });
    }

    cargar(selector, opciones = [], id = null) {
        let select = document.querySelector(selector);
        if (!select) return;

        select.innerHTML = '';

        opciones.forEach(opcion => {
            select.innerHTML += `
            <option value="${opcion.id}">
                ${opcion.nombre}
            </option>
        `;
        });

        if (select.tomselect && id != null) {
            select.tomselect.clear();
            select.tomselect.setValue(String(id));
        }
    }

}
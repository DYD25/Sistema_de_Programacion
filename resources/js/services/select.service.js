import TomSelect from 'tom-select';
import 'tom-select/dist/css/tom-select.css';

export default class SelectService {

    iniciar(selector = '.select') {

        document.querySelectorAll(selector).forEach(element => {

            if (element.tomselect) return;

            new TomSelect(element, {
                create: false,
                allowEmptyOption: true,
                placeholder: 'Seleccione una opción'
            });

        });

    }

}
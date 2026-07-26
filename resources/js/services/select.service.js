import TomSelect from 'tom-select';

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
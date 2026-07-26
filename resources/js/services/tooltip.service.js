import tippy from 'tippy.js';
import 'tippy.js/dist/tippy.css';

export default class TooltipService {

    iniciar() {
        this.recargar();
    }

    recargar() {

        tippy('[data-tooltip]', {
            content(reference) {
                return reference.dataset.tooltip;
            },
            placement: 'top',
            animation: 'shift-away',
            theme: 'light-border',
        });

    }


}
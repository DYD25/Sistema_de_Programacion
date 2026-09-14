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
            delay: [50, 0],
            duration: [150, 100],
            theme: 'light-border',
        });
    }


}
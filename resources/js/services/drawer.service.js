export default class DrawerService {

    abrir(id) {
        window.dispatchEvent(
            new CustomEvent('drawer-open', {
                detail: { id }
            })
        );
    }

    cerrar(id) {
        window.dispatchEvent(
            new CustomEvent('drawer-close', {
                detail: { id }
            })
        );
    }

    toggle(id) {
        window.dispatchEvent(
            new CustomEvent('drawer-toggle', {
                detail: { id }
            })
        );
    }

    loading(id) {
        window.dispatchEvent(
            new CustomEvent('drawer-loading', {
                detail: { id }
            })
        );
    }

    loaded(id) {
        window.dispatchEvent(
            new CustomEvent('drawer-loaded', {
                detail: { id }
            })
        );
    }
}
export default class ModalService {

    abrir(nombre) {
        window.dispatchEvent(
            new CustomEvent('open-modal', {
                detail: nombre
            })
        );
    }

    cerrar(nombre) {

        window.dispatchEvent(
            new CustomEvent('close-modal', {
                detail: nombre
            })
        );

    }
    

}
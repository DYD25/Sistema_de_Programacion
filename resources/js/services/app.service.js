import Services from ".";

export default class AppService {

    iniciar() {

        this.inicializarServicios();
        this.inicializarPlugins();

    }

    inicializarServicios() {

        Services.iglesia.inicializar();
        Services.notificacion.inicializar();
        
    }
    inicializarPlugins() {

        Services.select.iniciar();
        Services.tooltip.iniciar();

    }
}
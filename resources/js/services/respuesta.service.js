import Services from '../services';
export default class RespuestaService {

    procesarError(datos, mensajeError) {

        if (!datos) {
            Services.alerta.error(mensajeError);
            return false;
        }

        if (datos.validacion) {
            Services.formulario.mostrarErroresCampos(datos.errores);
            Services.notificacion.info(datos.mensaje);
            return false;
        }

        if (datos.excepcion) {
            Services.notificacion.warning(datos.mensaje);
            return false;
        }

        if (datos.error) {
            Services.notificacion.error(datos.mensaje);
            return false;
        }

        return true;
    }

}
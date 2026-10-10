import Services from '.';
export default class procesarPeticionService {

    async consultaGeneral(ruta,error, { loader = false } = {},datos = {}) {
        let mensajeError = `No se pudo completar la solicitud para ${error}`;
        let respuesta = await Services.peticion.request(ruta, {
            data: datos,
            loader
        });

        if (!this.procesarError(respuesta, mensajeError)) {
            return null;
        }

        return respuesta;
    }


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
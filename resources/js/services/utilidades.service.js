export default class UtilidadesService {

    inicialesNombre(nombre) {
        return nombre.trim().split(/\s+/).slice(0, 2)
            .map(nombre => nombre.charAt(0).toUpperCase())
            .join('');
    }

}
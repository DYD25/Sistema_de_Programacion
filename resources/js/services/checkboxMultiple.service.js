export default class CheckboxMultipleService {

    crear(datos, seleccionados = []) {

        return datos.map(dato => {
            return `
                <div class="flex items-center gap-4 border-b p-2 border-slate-200">
                    <label for="${dato.id}" class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" id="${dato.id}" name="datos[]" value="${dato.id}" class="estilos-checkbox" ${seleccionados.includes(dato.id) ? 'checked' : ''}>
                        <div class="flex items-center gap-3">
                            <div class="avatar-iniciales">
                                ${Services.utilidades.inicialesNombre(dato.nombre)}
                            </div>
                            <span class="font-medium">${dato.nombre}</span>
                        </div>
                    </label>
                </div>
            `;
        }).join('');
    }

    obtenerSeleccionados(nombre = 'datos[]') {
        return [...document.querySelectorAll(`input[name="${nombre}"]:checked`)]
            .map(checkbox => checkbox.value);
    }
}
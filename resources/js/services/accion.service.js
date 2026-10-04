export default class AccionService {

    constructor() {
        this.estilos = 'p-0-4 rounded-lg transition-colors transition-transform duration-150 active:scale-90';
    }

    botones(datos, opciones = {}) {

        let html = `<div class="flex justify-center gap-2">`;
        
        if (opciones.estado ?? true) {
            html += this.botonEstado(datos.id, datos.estado);
        }

        if (opciones.editar ?? true) {
            html += this.botonEditar(datos.id);
        }

        if (typeof opciones.extra === 'function') {
            //agregar this.estilos al boton extra
            html += opciones.extra(datos);
        }

        if (opciones.eliminar ?? true) {
            html += this.botonEliminar(datos.id);
        }

        html += `</div>`;
        return html;
    }

    botonEditar(id) {

        return `
            <button
                class="btn-editar ${this.estilos}"
                data-id="${id}"
                data-tooltip="Editar">
              <i data-lucide="square-pen"></i> 
            </button>
        `;
    }

    botonEstado(id, estado) {
        return `
            <button
                class="btn-estado ${this.estilos} ${estado ? 'estado_inactivo' : 'estado_activo'}"
                data-id="${id}"
                data-estado="${estado}"
                data-tooltip="${estado ? 'Desactivar' : 'Activar'}">
                <i data-lucide="${estado ? 'info' : 'circle-check-big'}"></i>
            </button>
        `;
    }

    botonEliminar(id) {
        return `
            <button
                class="btn-eliminar ${this.estilos}"
                data-id="${id}"
                data-tooltip="Eliminar">               
                <i data-lucide="trash-2"></i> 
            </button>
        `;
    }
}
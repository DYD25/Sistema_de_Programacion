export default class AccionService {

    constructor() {
        this.estilos = {
            editar: 'p-0-4 rounded-lg transition-colors',
            estado: 'p-0-4 rounded-lg transition-colors',
            eliminar: 'p-0-4 rounded-lg transition-colors'
        };
    }

    botones(datos, opciones = {}) {

        let html = `<div class="flex justify-center gap-2">`;
        
        if (opciones.estado ?? true) {
            html += this.botonEstado(datos.id, datos.estado);
        }

        if (opciones.editar ?? true) {
            html += this.botonEditar(datos.id);
        }

        if (opciones.eliminar ?? true) {
            html += this.botonEliminar(datos.id);
        }

        if (typeof opciones.extra === 'function') {
            html += opciones.extra(datos);
        }

        html += `</div>`;

        return html;
    }

    botonEditar(id) {

        return `
            <button
                class="btn-editar ${this.estilos.editar}"
                data-id="${id}"
                data-tooltip="Editar">
              <i data-lucide="square-pen"></i> 
            </button>
        `;
    }

    botonEstado(id, estado) {
        return `
            <button
                class="btn-estado ${this.estilos.estado} ${estado ? 'estado_inactivo' : 'estado_activo'}"
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
                class="btn-eliminar ${this.estilos.eliminar}"
                data-id="${id}"
                data-tooltip="Eliminar">               
                <i data-lucide="trash-2"></i> 
            </button>
        `;
    }
}
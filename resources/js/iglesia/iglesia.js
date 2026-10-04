import Services from '../services';
import { createIcons, icons } from 'lucide';

class Iglesia {
    constructor() {
        this.enviarDatos = [];
    }

    cargarMetodos() {
        if (!Services.iglesia.validarContexto()) return;
        Services.iglesia.inicializar();
        this.inicializarEventos();
        this.consultarDatosTable();
    }

    async consultaGeneral(error, ruta, { loader = false } = {}) {
        const mensajeError = `No se pudo completar la solicitud para ${error}`;
        const respuesta = await Services.peticion.request(ruta, {
            data: this.enviarDatos,
            loader
        });

        if (!Services.respuesta.procesarError(respuesta, mensajeError)) {
            return null;
        }

        this.enviarDatos = {};
        return respuesta;
    }

    inicializarEventos() {
        Services.formulario.onSubmit('form-crear-iglesia', () => this.guardarIglesia());
        Services.formulario.onClick('btn-crear-iglesia', () => this.iglesiaModal('nuevo'));
        Services.formulario.onClick('btn-cancelar', () => Services.drawer.cerrar('crear-iglesia'));
    }

    async consultarDatosTable() {
        let respuesta = await this.consultaGeneral('consultar los datos', 'consultar-datos-tabla-iglesia', { loader: 'progress' });
        if (!respuesta) return;
        this.cargarTabla(respuesta.data);
    }

    cargarTabla(datos) {
        Services.tabla.crear({
            id: '#table_iglesia',
            data: datos,
            columns: [
                {
                    data: 'nombre',
                    render: function (data) {
                        let iniciales = Services.utilidades.inicialesNombre(data);
                        return `
                            <div class="flex items-center gap-3">
                                <div class="avatar-iniciales">
                                    ${iniciales}
                                </div>
                                <span  class="font-medium">${data}</span>
                            </div>
                        `;
                    }
                },
                { data: 'direccion' },
                { data: 'ciudad' },
                { data: 'created_at',
                    render: function (data) {
                        if (!data) return '';
                        return new Date(data).toLocaleDateString('es-CO');
                    }
                 },
                {
                    data: 'estado',
                    className: 'text-center',
                    render: function (data) {
                        return data == 1
                            ? `<span class="estado-badge  estado-activo">Activo</span>`
                            : `<span class="estado-badge estado-inactivo">Inactivo</span>`;
                    }
                },
                {
                    data: null, className: 'text-center',
                    render: (data) => Services.accion.botones(data)
                }
            ],

            // exportar: ['excel', 'pdf']
        });

        this.btnEditar();
        this.btnEstado();
        this.btnEliminar();
    }

    btnEditar() {
        Services.tabla.evento('#table_iglesia', '.btn-editar', (iglesia) => {
            this.iglesiaModal('editar');
            document.getElementById('nombre').value = iglesia.nombre;
            document.getElementById('direccion').value = iglesia.direccion;
            document.getElementById('ciudad').value = iglesia.ciudad;
            this.iglesiaId = iglesia.id;
        });
    }

    btnEstado() {
        Services.tabla.evento('#table_iglesia', '.btn-estado', async (iglesia) => {
            this.enviarDatos = {
                id: iglesia.id,
                estado: iglesia.estado,
            };

            let respuesta = await this.consultaGeneral('actualizar el estado', 'estado-iglesia', { loader: 'progress' });
            if (!respuesta) return;

            Services.notificacion.success(respuesta.mensaje);
            this.consultarDatosTable();
        });
    }

    btnEliminar() {
        Services.tabla.evento('#table_iglesia', '.btn-eliminar', (iglesia) => {
            Services.swal.fire({
                title: `Eliminar Registro`,
                html: `¿Está seguro de eliminar el registro de <b>${iglesia.nombre}?</b> </br> Esta acción no se puede deshacer.`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: `Si, Eliminar`,
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.eliminar(iglesia.id);
                }
            });
        });
    }

    async eliminar(id) {
        this.enviarDatos = { id: id, };
        
        let respuesta = await this.consultaGeneral('eliminar el iglesia', 'eliminar-iglesia', { loader: 'progress' });
        if (!respuesta) return;

        Services.notificacion.success(respuesta.mensaje);
        this.consultarDatosTable();
    }

    iglesiaModal(tipo) {
        let titulo = document.getElementById('titulo-modal');
        let texto = document.getElementById('span-guardar');
        let icono = document.getElementById('icono-guardar');
        let mensajeLoading = document.getElementById('mensaje-loading');

        if (tipo === 'nuevo') {
            titulo.textContent = 'Registrar nueva Iglesia';
            texto.textContent = 'Guardar Iglesia';
            icono.setAttribute('data-lucide', 'save-check');
            mensajeLoading.textContent = 'Guardando información...';
            this.iglesiaId = null;

        } else {
            titulo.textContent = 'Editar Iglesia';
            texto.textContent = 'Actualizar Iglesia';
            icono.setAttribute('data-lucide', 'square-pen');
            mensajeLoading.textContent = 'Actualizando información...';
        }

        createIcons({ icons });
        Services.formulario.reiniciar('form-crear-iglesia');
        Services.drawer.abrir('crear-iglesia'); 
        this.enviarDatos = [];
    }

    async guardarIglesia() {
        Services.formulario.limpiarErroresCampos('form-crear-iglesia');
        this.enviarDatos = Services.formulario.obtenerDatos('form-crear-iglesia');
        
        let ruta = 'crear';
        if (this.iglesiaId) {
            this.enviarDatos.id = this.iglesiaId;
            ruta = 'actualizar'
        }

        let respuesta = await this.consultaGeneral(ruta + ' el iglesia', ruta+'-iglesia', { loader: { type: 'drawer', id: 'crear-iglesia' } });
        if (!respuesta) return;

        Services.drawer.cerrar('crear-iglesia');
        Services.notificacion.success(respuesta.mensaje);
        this.consultarDatosTable();
    }
}

const iglesia = new Iglesia();
iglesia.cargarMetodos();

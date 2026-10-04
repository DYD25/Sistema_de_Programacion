import Services from '../services';
import { createIcons, icons } from 'lucide';

class Area {
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
        Services.formulario.onSubmit('form-crear-area', () => this.guardarArea());
        Services.formulario.onClick('btn-crear-area', () => this.areaModal('nuevo'));
        Services.formulario.onClick('btn-cancelar', () => Services.drawer.cerrar('crear-area'));
    }

    async consultarDatosTable() {
        let respuesta = await this.consultaGeneral('consultar los datos', 'consultar-datos-tabla-area', { loader: 'progress' });
        if (!respuesta) return;
        this.cargarTabla(respuesta.data);
    }

    cargarTabla(datos) {
        Services.tabla.crear({
            id: '#table_areas',
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
                { data: 'descripcion' },
                { data: 'usa_grupo',
                    className: 'text-center',
                    render: function (data) {
                        return data == 1 
                        ? `<span class="bg-verder">Sii</span>`
                        : `<span class="bg-rojo">No</span>`;
                    }
                },
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
                            ? `<span class="estado-badge estado-activo">Activo</span>`
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
        Services.tabla.evento('#table_areas', '.btn-editar', (area) => {
            this.areaModal('editar');
            document.getElementById('nombre').value = area.nombre;
            document.getElementById('descripcion').value = area.descripcion;
            document.getElementById('usa_grupo').checked = area.usa_grupo == 1;
            this.areaId = area.id;
        });
    }

    btnEstado() {
        Services.tabla.evento('#table_areas', '.btn-estado', async (area) => {
            this.enviarDatos = {
                id: area.id,
                estado: area.estado,
            };

            this.ejecutarBotones('actualizar el estado', 'estado-area');
        });
    }

    btnEliminar() {
        Services.tabla.evento('#table_areas', '.btn-eliminar', (area) => {
            Services.swal.fire({
                title: `Eliminar Registro`,
                html: `¿Está seguro de eliminar el registro de <b>${area.nombre}?</b> </br> Esta acción no se puede deshacer.`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: `Si, Eliminar`,
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.enviarDatos = { id: area.id, };
                    this.ejecutarBotones('eliminar la area', 'eliminar-area');
                }
            });
        });
    }

    async ejecutarBotones(mensajeError, ruta) {
        let respuesta = await this.consultaGeneral(mensajeError, ruta, { loader: 'progress' });
        if (!respuesta) return;

        Services.notificacion.success(respuesta.mensaje);
        this.consultarDatosTable();
    }

    areaModal(tipo) {
        let titulo = document.getElementById('titulo-modal');
        let texto = document.getElementById('span-guardar');
        let icono = document.getElementById('icono-guardar');
        let mensajeLoading = document.getElementById('mensaje-loading');

        if (tipo === 'nuevo') {
            titulo.textContent = 'Registrar Nuevo Area';
            texto.textContent = 'Guardar Area';
            icono.setAttribute('data-lucide', 'save-check');
            mensajeLoading.textContent = 'Guardando información...';
            this.personaId = null;

        } else {
            titulo.textContent = 'Editar area';
            texto.textContent = 'Actualizar area';
            icono.setAttribute('data-lucide', 'square-pen');
            mensajeLoading.textContent = 'Actualizando información...';
        }

        createIcons({ icons });
        Services.formulario.reiniciar('form-crear-area');
        Services.drawer.abrir('crear-area');
        this.enviarDatos = [];
    }

    async guardarArea() {
        Services.formulario.limpiarErroresCampos('form-crear-area');
        this.enviarDatos = Services.formulario.obtenerDatos('form-crear-area');
        this.enviarDatos.usa_grupo = document.getElementById('usa_grupo').checked ? 1 : 0;
        
        let ruta = 'crear';
        if (this.areaId) {
            this.enviarDatos.id = this.areaId;
            ruta = 'actualizar'
        }

        let respuesta = await this.consultaGeneral(ruta + ' el area', ruta+'-area', { loader: { type: 'drawer', id: 'crear-area' } });
        if (!respuesta) return;

        Services.drawer.cerrar('crear-area');
        Services.notificacion.success(respuesta.mensaje);
        this.consultarDatosTable();
    }
}

const area = new Area();
area.cargarMetodos();

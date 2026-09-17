import Services from '../services';
import { createIcons, icons } from 'lucide';

class Cargo {
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
        Services.formulario.onSubmit('form-crear-cargo', () => this.guardarCargo());
        Services.formulario.onClick('btn-crear-cargo', () => this.cargoModal('nuevo'));
        Services.formulario.onClick('btn-cancelar', () => Services.drawer.cerrar('crear-cargo'));
    }

    async consultarDatosTable() {
        let respuesta = await this.consultaGeneral('consultar los datos', 'consultar-datos-tabla-cargo', { loader: 'progress' });
        if (!respuesta) return;
        this.cargarTabla(respuesta.data);
    }

    cargarTabla(datos) {
        Services.tabla.crear({
            id: '#table_cargo',
            data: datos,
            columns: [
                {
                    data: 'nombre',
                    render: function (data) {

                        const iniciales = data
                            .trim()
                            .split(/\s+/)
                            .slice(0, 2)
                            .map(nombre => nombre.charAt(0).toUpperCase())
                            .join('');

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
        Services.tabla.evento('#table_cargo', '.btn-editar', (cargo) => {
            this.cargoModal('editar');
            document.getElementById('nombre').value = cargo.nombre;
            document.getElementById('descripcion').value = cargo.descripcion;
            this.cargoId = cargo.id;
        });
    }

    btnEstado() {
        Services.tabla.evento('#table_cargo', '.btn-estado', async (cargo) => {
            this.enviarDatos = {
                id: cargo.id,
                estado: cargo.estado,
            };

            let respuesta = await this.consultaGeneral('actualizar el estado', 'estado-cargo', { loader: 'progress' });
            if (!respuesta) return;

            Services.notificacion.success(respuesta.mensaje);
            this.consultarDatosTable();
        });
    }

    btnEliminar() {
        Services.tabla.evento('#table_cargo', '.btn-eliminar', (cargo) => {
            Services.swal.fire({
                title: `Eliminar Registro`,
                html: `¿Está seguro de eliminar el registro de <b>${cargo.nombre}?</b> </br> Esta acción no se puede deshacer.`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: `Si, Eliminar`,
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.eliminar(cargo.id);
                }
            });
        });
    }

    async eliminar(id) {
        this.enviarDatos = { id: id, };
        
        let respuesta = await this.consultaGeneral('eliminar el cargo', 'eliminar-cargo', { loader: 'progress' });
        if (!respuesta) return;

        Services.notificacion.success(respuesta.mensaje);
        this.consultarDatosTable();
    }

    cargoModal(tipo) {
        let titulo = document.getElementById('titulo-modal');
        let texto = document.getElementById('span-guardar');
        let icono = document.getElementById('icono-guardar');
        let mensajeLoading = document.getElementById('mensaje-loading');

        if (tipo === 'nuevo') {
            titulo.textContent = 'Registrar nuevo Cargo';
            texto.textContent = 'Guardar Cargo';
            icono.setAttribute('data-lucide', 'save-check');
            mensajeLoading.textContent = 'Guardando información...';
            this.personaId = null;

        } else {
            titulo.textContent = 'Editar Cargo';
            texto.textContent = 'Actualizar Cargo';
            icono.setAttribute('data-lucide', 'square-pen');
            mensajeLoading.textContent = 'Actualizando información...';
        }

        createIcons({ icons });
        Services.formulario.reiniciar('form-crear-cargo');
        Services.drawer.abrir('crear-cargo');
        this.enviarDatos = [];
    }

    async guardarCargo() {
        Services.formulario.limpiarErroresCampos('form-crear-cargo');
        this.enviarDatos = Services.formulario.obtenerDatos('form-crear-cargo');
        
        let ruta = 'crear';
        if (this.cargoId) {
            this.enviarDatos.id = this.cargoId;
            ruta = 'actualizar'
        }

        let respuesta = await this.consultaGeneral(ruta + ' el cargo', ruta+'-cargo', { loader: { type: 'drawer', id: 'crear-cargo' } });
        if (!respuesta) return;

        Services.drawer.cerrar('crear-cargo');
        Services.notificacion.success(respuesta.mensaje);
        this.consultarDatosTable();
    }
}

const cargo = new Cargo();
cargo.cargarMetodos();

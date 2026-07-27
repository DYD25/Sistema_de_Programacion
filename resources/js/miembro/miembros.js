import Services from '../services';
import { createIcons, icons } from 'lucide';


class Miembro {
    constructor() {
        // this.formulario = formularioService;
        this.id_facturador = 2;
        this.enviarDatos = [];
    }

    cargarMetodos() {
        if (!Services.iglesia.validarContexto()) return;
        Services.iglesia.inicializar();
        this.inicializarEventos();
        this.consultarDatosTable();
        // this.btnEditar();
    }

    async consultaGeneral(error, ruta, { loader = false } = {}) {
        const mensajeError = `No se pudo completar la solicitud para ${error}`;
        const respuesta = await Services.peticion.request(ruta, {
            data: this.enviarDatos,
            loader
        });

        if (!this.procesarRespuestaError(respuesta, mensajeError)) {
            return null;
        }

        this.enviarDatos = {};
        return respuesta;
    }

    procesarRespuestaError(datos, mensaje_error) {

        if (!datos) {
            Services.alerta.error(mensaje_error);
            return false;
        }

        if (datos.validacion) {
            Services.formulario.mostrarErroresCampos(datos.errores);
            Services.notificacion.warning(datos.mensaje);
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

    inicializarEventos() {
        Services.formulario.onSubmit('form-crear-persona', () => this.guardarPersona());
        Services.formulario.onClick('btn-crear-persona', () => this.personaModal('nuevo'));
        Services.formulario.onClick('btn-cancelar', () => Services.drawer.cerrar('crear-persona'));
    }

    async consultarDatosTable() {
        let respuesta = await this.consultaGeneral('cunsulta los datos', 'consultar-datos-tabla', { loader: 'progress' });
        if (!respuesta) return;
        this.cargarTabla(respuesta.data);
        this.actualizarGraficas(respuesta.estadisticas);
        this.actualizarCards(respuesta.estadisticas);

    }

    actualizarGraficas(datos) {

        const { historico, porcentaje_activos } = datos;

        Services.chart.crearSparkline(
            'grafica-total-miembros',
            historico.total,
        );

        Services.chart.crearMiniBar(
            'grafica-activos-miembro',
            historico.activos
        );

        Services.chart.crearMiniBar(
            'grafica-inactivos-miembro',
            historico.inactivos,
            '#ef4444'
        );

        Services.chart.crearMiniRadial(
            'grafica-radial-miembro',
            porcentaje_activos
        );

    }

    actualizarCards(datos) {

        Services.card.actualizar({

            'card-total': datos.total,
            'card-activos': datos.activos,
            'card-inactivos': datos.inactivos,
            'card-general': `${datos.porcentaje_activos}%`,
            'porcentaje-activos': `${datos.porcentaje_activos}% del total`,
            'porcentaje-inactivos': `${datos.porcentaje_inactivos}% del total`,
            'estado-general': this.obtenerEstado(datos.porcentaje_activos),
            'crecimiento-miembros': `▲ +${datos.crecimiento_mes} este mes`,
        });
    }

    obtenerEstado(porcentaje) {

        if (porcentaje >= 90) return 'Excelente';
        if (porcentaje >= 75) return 'Muy bueno';
        if (porcentaje >= 60) return 'Bueno';
        if (porcentaje >= 40) return 'Regular';

        return 'Crítico';
    }

    cargarTabla(datos) {
        Services.tabla.crear({
            id: '#table_persona',
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
                { data: 'nombre_whatsapp' },
                { data: 'telefono' },
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
        Services.tabla.evento('#table_persona', '.btn-editar', (persona) => {
            this.personaModal('editar');
            document.getElementById('nombre').value = persona.nombre;
            document.getElementById('nombre_whatsapp').value = persona.nombre_whatsapp;
            document.getElementById('telefono').value = persona.telefono;
            this.personaId = persona.id;
        });
    }

    btnEstado() {
        Services.tabla.evento('#table_persona', '.btn-estado', async (datos) => {
            this.enviarDatos = {
                id: datos.id,
                estado: datos.estado
            };

            let respuesta = await this.consultaGeneral('actualizar el estado la persona', 'estado', { loader: 'progress' });
            if (!respuesta) return;
            Services.notificacion.success(respuesta.mensaje);
            this.consultarDatosTable();
        });
    }

    btnEliminar() {
        Services.tabla.evento('#table_persona', '.btn-eliminar', (datos) => {

            Swal.fire({
                title: `Eliminar Registro`,
                html: `¿Está seguro de eliminar el registro de <b>${datos.nombre}?</b> </br> Esta acción no se puede deshacer.`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: `Si, Eliminar`,
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.eliminar(datos.id);
                }
            });
        }
        );
    }

    async eliminar(id) {
        this.enviarDatos = { id: id, };

        let respuesta = await this.consultaGeneral('eliminar el registro la persona', 'eliminar', { loader: 'progress' });
        if (!respuesta) return;
        Services.notificacion.success(respuesta.mensaje);
        this.consultarDatosTable();
    }

    personaModal(tipo) {
        let titulo = document.getElementById('titulo-modal');
        let texto = document.getElementById('span-guardar');
        let icono = document.getElementById('icono-guardar');
        let mensajeLoading = document.getElementById('mensaje-loading');

        if (tipo === 'nuevo') {
            titulo.textContent = 'Registrar nueva Persona';
            texto.textContent = 'Guardar Persona';
            icono.setAttribute('data-lucide', 'save-check');
            mensajeLoading.textContent = 'Guardando información...';
            this.personaId = null;

        } else {
            titulo.textContent = 'Editar Persona';
            texto.textContent = 'Actualizar Persona';
            icono.setAttribute('data-lucide', 'square-pen');
            mensajeLoading.textContent = 'Actualizando información...';
        }

        createIcons({ icons });
        Services.formulario.reiniciar('form-crear-persona');
        Services.drawer.abrir('crear-persona');
        this.enviarDatos = [];
    }

    async guardarPersona() {
        this.enviarDatos = Services.formulario.obtenerDatos('form-crear-persona');
        if (this.personaId) {
            this.enviarDatos.id = this.personaId;
        }

        let ruta = this.personaId ? 'actualizar' : 'crear';
        let respuesta = await this.consultaGeneral(ruta + ' la persona', ruta, { loader: { type: 'drawer', id: 'crear-persona' } });
        if (!respuesta) return;

        Services.drawer.cerrar('crear-persona');
        Services.notificacion.success(respuesta.mensaje);
        this.consultarDatosTable();
    }


}

const miembro = new Miembro();
miembro.cargarMetodos();
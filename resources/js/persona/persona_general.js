import Services from '../services';
import { createIcons, icons } from 'lucide';

class Persona {
    constructor() {
        this.enviarDatos = [];
    }

    cargarMetodos() {
        if (!Services.iglesia.validarContexto()) return;
        Services.iglesia.inicializar();
        this.inicializarEventos();
        this.consultarDatosTable();
    }

    // async consultaGeneral(error, ruta, { loader = false } = {}) {
    //     const mensajeError = `No se pudo completar la solicitud para ${error}`;
    //     const respuesta = await Services.peticion.request(ruta, {
    //         data: this.enviarDatos,
    //         loader
    //     });

    //     if (!Services.respuesta.procesarError(respuesta, mensajeError)) {
    //         return null;
    //     }

    //     this.enviarDatos = {};
    //     return respuesta;
    // }

    inicializarEventos() {
        Services.formulario.onSubmit('form-crear-persona', () => this.guardarPersona());
        Services.formulario.onClick('btn-crear', () => this.personaDrawer('nuevo'));
        Services.formulario.onClick('btn-cancelar', () => Services.drawer.cerrar('crear-persona'));
        Services.formulario.onSubmit('form-asignar-areas', () => this.guardarAsignarAreas());
    }

    async consultarDatosTable() {
        let respuesta = await Services.procesarPeticion.consultaGeneral('consultar-datos-tabla-persona','cunsulta los datos', { loader: 'progress' });
        if (!respuesta) return;

        this.cargarTabla(respuesta.data);
        this.actualizarGraficas(respuesta.estadisticas);
        this.actualizarCards(respuesta.estadisticas);

    }

    actualizarGraficas(datos) {

        const { historico, porcentaje_activos, porcentaje_inactivos } = datos;

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

        Services.chart.crearMiniBarComparativo(
            'grafica-general-miembro',
            [
                porcentaje_activos,
                porcentaje_inactivos
            ],
            [
                'Activos',
                'Inactivos'
            ],
            55
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
            id: '#table_personas',
            data: datos,
            columns: [
                {
                    data: 'nombre_completo',
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
                { data: 'telefono' },
                { data: 'fecha_nacimiento' },
                {
                    data: 'areas',
                    className: 'text-center',
                    render: function (data, type, row) {

                        let nombres = data.map(area => area.nombre).join(', ') || 'Sin asignar';

                        return `
                            <span data-tooltip="${nombres}" class="cursor-pointer">
                                ${row.areas_count}
                            </span>
                        `;
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
                    render: (data) => Services.accion.botones(data, {
                        extra: (datos) => {
                            return `
                            <button
                                type="button"
                                class="btn-asignar-areas p-0-4 rounded-lg transition-colors transition-transform duration-150 active:scale-90"
                                data-id="${datos.id}"
                                data-tooltip="Asignar Areas/Ministerios">
                                <i data-lucide="user-key" class="w-4 h-4"></i>
                            </button>
                        `;
                        }
                    })
                }
            ],

            // exportar: ['excel', 'pdf']
        });

        this.btnEditar();
        this.btnEstado();
        this.btnAsignarAreas();
        this.btnEliminar();
    }

    btnEditar() {
        Services.tabla.evento('#table_personas', '.btn-editar', (persona) => {
            this.personaDrawer('editar');
            document.getElementById('nombres').value = persona.nombres;
            document.getElementById('apellidos').value = persona.apellidos;
            document.getElementById('telefono').value = persona.telefono;
            document.getElementById('fecha_nacimiento').value = persona.fecha_nacimiento;
            this.personaId = persona.id;
        });
    }

    btnEstado() {
        Services.tabla.evento('#table_personas', '.btn-estado', async (datos) => {
            this.enviarDatos = {
                id: datos.id,
                estado: datos.estado
            };
            this.ejecutarAcciones( 'estado-persona','actualizar el estado la persona');
        });
    }

    btnAsignarAreas() {
        Services.tabla.evento('#table_personas', '.btn-asignar-areas', async (datos) => {
            Services.drawer.loaded('asignar-areas');
            let respuesta = await this.consultarAreas();
            if (!respuesta) return;
            
            document.getElementById('contenedor-areas').innerHTML = Services.checkboxMultiple.crear(respuesta, datos.areas.map(area => area.id));
            window.dispatchEvent(new CustomEvent('open-modal', { detail: 'asignar-areas' }));

            this.personaId = datos.id;
            Services.formulario.onClick('btn-cancelar-areas', () => this.cerrarModal());
        });
    }

    async consultarAreas() {
        if (this.areasConsultadas) return this.areasConsultadas;

        let respuesta = await Services.procesarPeticion.consultaGeneral('consultar-areas','consultar las areas');
        if (!respuesta) return;

        this.areasConsultadas = respuesta.data;
        return respuesta.data;
    }

    btnEliminar() {
        Services.tabla.evento('#table_personas', '.btn-eliminar', (datos) => {
            Services.swal.fire({
                title: `Eliminar Registro`,
                html: `¿Está seguro de eliminar el registro de <b>${datos.nombres}?</b> </br> Esta acción no se puede deshacer.`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: `Si, Eliminar`,
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.enviarDatos = { id: datos.id, id_area: datos.areas.map(area => area.id)};
                    this.ejecutarAcciones( 'eliminar-persona','eliminar el registro la persona',);
                }
            });
        });
    }

    personaDrawer(tipo) {
        let titulo = document.getElementById('titulo-drawer');
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
        Services.formulario.limpiarErroresCampos('form-crear-persona');
        this.enviarDatos = Services.formulario.obtenerDatos('form-crear-persona');

        let ruta = 'crear';
        if (this.personaId) {
            this.enviarDatos.id = this.personaId;
            ruta = 'actualizar'
        }

        let respuesta = await Services.procesarPeticion.consultaGeneral(ruta+'-persona', ruta+'la persona persona', { loader: { type: 'drawer', id: 'crear-persona' } }, this.enviarDatos);
        if (!respuesta) return;

        Services.drawer.cerrar('crear-persona');
        Services.notificacion.success(respuesta.mensaje);
        this.consultarDatosTable();
        this.enviarDatos = [];
    }

    async guardarAsignarAreas() {
        let seleccionados = Services.checkboxMultiple.obtenerSeleccionados('datos[]');
        this.enviarDatos = {
            id_persona: this.personaId,
            areas: seleccionados
        };

        this.ejecutarAcciones('asignar-areas','asignar las areas');
    }

    async ejecutarAcciones(ruta,mensajeError) {  
        let respuesta = ruta !== 'asignar-areas' ? await Services.procesarPeticion.consultaGeneral(ruta, mensajeError,  { loader: 'progress' }, this.enviarDatos) 
        : await Services.procesarPeticion.consultaGeneral(ruta, mensajeError, { loader: { type: 'drawer', id: 'asignar-areas' }}, this.enviarDatos);
                                 
        if (!respuesta) return;

        if(ruta === 'asignar-areas'){
            window.dispatchEvent(new CustomEvent('close-modal', { detail: 'asignar-areas' }));
        }
        
        Services.notificacion.success(respuesta.mensaje);
        this.consultarDatosTable();
        this.enviarDatos = [];

    }

    cerrarModal() {
        window.dispatchEvent(new CustomEvent('close-modal', { detail: 'asignar-areas' }));
    }

}

const persona = new Persona();
persona.cargarMetodos();

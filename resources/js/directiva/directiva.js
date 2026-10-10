import Services from '../services';
import { createIcons, icons } from 'lucide';
import PasswordService from '../auth/password.service';


class Directiva {
    constructor() {
        this.enviarDatos = [];
    }

    cargarMetodos() {
        if (!Services.iglesia.validarContexto()) return;
        Services.iglesia.inicializar();
        this.consultarCargos();
        this.consultarPersonas();
        this.inicializarEventos();
        this.consultarDatosTable();
    }

    async consultarPersonas() {
        if (this.personas) {
            this.cargarPersona();
            return;
        }

        let respuesta = await Services.procesarPeticion.consultaGeneral('obtener-personas','consultar las directivas',  { loader: 'progress' });
        if (!respuesta) return;

        this.personas = respuesta.data;
        this.cargarPersona();
    }

    cargarPersona(id) {
        Services.select.cargar('#id_persona', this.personas, id);
        Services.select.iniciar('#id_persona');
    }

    async consultarCargos() {
        if (this.cargos) {
            this.cargarCargo();
            return;
        }

        let respuesta = await Services.procesarPeticion.consultaGeneral('obtener-cargos', 'consultar los cargos', { loader: 'progress' });
        if (!respuesta) return;

        this.cargos = respuesta.data;
        this.cargarCargo();
    }

    cargarCargo(id) {
        Services.select.cargar('#id_cargo', this.cargos, id);
        Services.select.iniciar('#id_cargo');
    }

    inicializarEventos() {
        $('#btn-crear').attr('data-tooltip', 'Crear directiva');
        Services.tooltip.recargar();
        Services.formulario.onClick('btn-crear', () => this.directivaDrawer('nuevo'));
        Services.formulario.onSubmit('form-crear-directivo', () => this.guardarDirectivo());
        Services.formulario.onClick('btn-cancelar', () => Services.drawer.cerrar('crear-directivo'));
    }

    async consultarDatosTable() {
        let respuesta = await Services.procesarPeticion.consultaGeneral('consultar-datos-tabla-directiva', 'cunsulta los datos', { loader: 'progress' },this.enviarDatos);
        if (!respuesta) return;
        this.cargarTabla(respuesta.data);
    }

    cargarTabla(datos) {
        Services.tabla.crear({
            id: '#table_directivos',
            data: datos,
            columns: [
                {
                    data: 'usuario.name',
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
                { data: 'directiva.nombre' },
                { data: 'cargo.nombre' },
                { data: 'usuario.email' },
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
        Services.tabla.evento('#table_directivo', '.btn-editar', (directiva) => {
            this.directivaDrawer('editar');
            document.getElementById('nombre').value = directiva.usuario.name;
            document.getElementById('correo').value = directiva.usuario.email;
            this.cargarDirectiva(directiva.directiva_id);
            this.cargarCargo(directiva.cargo_id);

            this.directivaId = directiva.id;
        });
    }

    btnEstado() {
        Services.tabla.evento('#table_directivos', '.btn-estado', async (directiva) => {
            this.enviarDatos = {
                id: directiva.id,
                estado: directiva.estado
            };

            let respuesta = await this.consultaGeneral('actualizar el estado de la directiva', 'estado-directiva', { loader: 'progress' });
            if (!respuesta) return;
            Services.notificacion.success(respuesta.mensaje);
            this.consultarDatosTable();
        });
    }

    btnEliminar() {
        Services.tabla.evento('#table_directivos', '.btn-eliminar', async (directiva) => {
            Services.swal.fire({
                title: `Eliminar Integrante`,
                html: `¿Está seguro de eliminar el integrante <b>${directiva.usuario.name}?</b> </br> Esta acción no se puede deshacer.`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: `Si, Eliminar`,
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.eliminar(directiva.id, directiva.usuario.email);
                }
            });
        });
    }

    async eliminar(id, correo) {
        this.enviarDatos = { id: id, correo: correo };
 
        let respuesta = await this.consultaGeneral('eliminar el integrante de la directiva', 'eliminar-directiva', { loader: 'progress' });
        if (!respuesta) return;
        Services.notificacion.success(respuesta.mensaje);
        this.consultarDatosTable();
    }

    directivaDrawer(tipo) {
        let titulo = document.getElementById('titulo-drawer');
        let texto = document.getElementById('span-guardar');
        let icono = document.getElementById('icono-drawer');
        let mensajeLoading = document.getElementById('mensaje-loading');

        if (tipo === 'nuevo') {
            titulo.textContent = 'Registrar Nuevo Directivo';
            texto.textContent = 'Guardar Directivo';
            icono.setAttribute('data-lucide', 'save-check');
            mensajeLoading.textContent = 'Guardando información...';
            this.directivaId = null;
            
            $('#id_cargo')[0].tomselect.setValue('');
            $('#id_persona')[0].tomselect.setValue('');   

            } else {
            titulo.textContent = 'Editar Integrante';
            texto.textContent = 'Actualizar Integrante';
            icono.setAttribute('data-lucide', 'square-pen');
            mensajeLoading.textContent = 'Actualizando información...';

        }

        createIcons({ icons });
        Services.formulario.reiniciar('form-crear-directivo');
        Services.drawer.abrir('crear-directivo');
        new PasswordService().inicializar();
        this.enviarDatos = [];
        this.gestionarCampos(tipo);
    }

    gestionarCampos(tipo) {
        let bool = tipo === 'nuevo' ? false : true;
        let correo = document.getElementById('correo');
        correo.disabled = bool;
        
        if (bool) {
            $('.div-contrasena').hide();
            $('.check').show();
            
        } else {
            $('.check').hide();
            $('.div-contrasena').show();
        }
        
        $('#check_password').prop('checked', !bool);
        $('#check_password').change(function () {
            $('.div-contrasena').toggle(this.checked);
        });
    }

    async guardarDirectivo() {
        Services.formulario.limpiarErroresCampos('form-crear-directivo');
        this.enviarDatos = Services.formulario.obtenerDatos('form-crear-directivo');

        if ($('#check_password').is(':checked')) {
            if (!this.validarContraseña()) return;
        } else {
            delete this.enviarDatos.password;
        }

        let ruta = 'crear';
        if (this.directivaId) {
            this.enviarDatos.id = this.directivaId;
            ruta = 'actualizar'
        }

        let respuesta = await Services.procesarPeticion.consultaGeneral( ruta + '-directiva', ruta + ' el directivo',{ loader: { type: 'drawer', id: 'crear-directiva' } });
        if (!respuesta) return;

        Services.drawer.cerrar('crear-directiva');
        Services.notificacion.success(respuesta.mensaje);
        this.consultarDatosTable();
    }

    validarContraseña() {
        let contraseña = document.querySelector('[name="password"]');
        let contraseñaConfirmar = document.querySelector('[name="confirmar_password"]');

        if (!contraseña?.value) {
            Services.formulario.mostrarErroresCampos({
                'password': ['Por favor, ingrese una contraseña']
            });
            return false;
        }

        if (contraseña.value !== contraseñaConfirmar?.value) {
            Services.formulario.mostrarErroresCampos({
                'confirmar_password': ['Las contraseñas no coinciden']
            });
            return false;
        }
        return true;
    }

    async ejecutarAcciones(ruta,mensajeError) {
        let respuesta = await Services.procesarPeticion.consultaGeneral(ruta, mensajeError, { loader: 'progress' },this.enviarDatos);
        if (!respuesta) return;

        Services.notificacion.success(respuesta.mensaje);
        this.consultarDatosTable();
    }

}

const directiva = new Directiva();
directiva.cargarMetodos();

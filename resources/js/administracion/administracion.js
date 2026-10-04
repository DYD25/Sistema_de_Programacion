import Services from '../services';
import { createIcons, icons } from 'lucide';
import PasswordService from '../auth/password.service';


class Administracion {
    constructor() {
        this.enviarDatos = {};
        this.permisosCargados = null;
        this.adminId = '';
    }

    tabActual = 'usuarios';
    configuracionTag = {
        usuario: {
            icono: 'user-group',
            btnTexto: 'Usuario',
            textoBoton: 'Nuevo Usuario',
            modal: 'crear-usuario',
            modal_form: 'form-crear-usuario',
            titulo_id: 'titulo-modal',
        },

        rol: {
            textoBoton: 'Nuevo Rol',
            modal: 'crear-rol',
            modal_form: 'form-rol',
            titulo_id: 'titulo-rol',
        },

        permiso: {
            textoBoton: 'Nuevo Permiso',
            modal: 'crear-permiso',
            modal_form: 'form-permiso',
            titulo_id: 'titulo-permiso',
        }

    };

    cargarMetodos() {
        if (!Services.iglesia.validarContexto()) return;
        Services.iglesia.inicializar();
        this.inicializarTabs();
        this.cambiarTab('rol');
        // this.consultarDatosTable();
        // this.consultarCargos();
        // this.consultarDirectivos();

    }

    inicializarTabs() {
        $('.tab-administracion').off('click').on('click', (e) => {
            let tab = $(e.currentTarget).data('tab');
            this.cambiarTab(tab);
        });

        Services.formulario.onClick('btn-crear', () => this.configuracionModal('nuevo'));
    }

    cambiarTab(tab) {
        let configuracion = this.configuracionTag[tab];

        if (!configuracion) {
            return;
        }

        this.tabActual = tab;
        this.activarTab(tab);
        this.actualizarBoton(configuracion);
        this.consultarDatosTable();
        Services.tooltip.recargar();

    }

    activarTab(tab) {
        $('.tab-administracion')
            .removeClass('border-green-600 text-green-600')
            .addClass('border-transparent text-slate-500');

        $(`.tab-administracion[data-tab="${tab}"]`)
            .removeClass('border-transparent text-slate-500')
            .addClass('border-green-600 text-green-600');

        if (tab === 'usuarios') {
            $('#tab-usuario').removeClass('hidden');
            $('#tab-rol, #tab-permiso').addClass('hidden');
        } else if (tab === 'rol') {
            $('#tab-rol').removeClass('hidden');
            $('#tab-usuario, #tab-permiso').addClass('hidden');
        } else if (tab === 'permiso') {
            $('#tab-permiso').removeClass('hidden');
            $('#tab-rol, #tab-usuario').addClass('hidden');
        }
    }

    actualizarBoton(configuracion) {
        let boton = $('#btn-crear').attr('data-tooltip', '');
        boton.attr('data-tooltip', configuracion.textoBoton);
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

    async consultarDirectivos() {
        if (this.directivos) {
            this.cargarDirectivo();
            return;
        }

        let respuesta = await this.consultaGeneral('consultar las directivas', 'obtener-directivas', { loader: 'progress' });
        if (!respuesta) return;

        this.directivos = respuesta.data;
        this.cargarDirectivo();
    }

    cargarDirectivo(id) {
        Services.select.cargar('#id_directivo', this.directivos, id);
        Services.select.iniciar('#id_directivo');
    }

    async consultarCargos() {
        if (this.cargos) {
            this.cargarCargo();
            return;
        }

        let respuesta = await this.consultaGeneral('consultar los cargos', 'obtener-cargos', { loader: 'progress' });
        if (!respuesta) return;

        this.cargos = respuesta.data;
        this.cargarCargo();
    }

    cargarCargo(id) {
        Services.select.cargar('#id_cargo', this.cargos, id);
        Services.select.iniciar('#id_cargo');
    }

    async consultarDatosTable() {
        let respuesta = await this.consultaGeneral('cunsulta los datos', 'consultar-datos-tabla-' + this.tabActual, { loader: 'progress' });
        if (!respuesta) return;

        if (this.tabActual === 'usuario') {
            this.cargarTablaUsuaros(respuesta.data);
        } else if (this.tabActual === 'rol') {
            this.cargarTablaRol(respuesta.data);
        } else if (this.tabActual === 'permiso') {
            this.cargarTablaPermiso(respuesta.data);
        }
    }

    cargarTablaUsuaros(datos) {
        Services.tabla.crear({
            id: '#table_directiva',
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

    //   btnEditar() {
    //     Services.tabla.evento('#table_directivo', '.btn-editar', (directiva) => {
    //         this.directivaModal('editar');
    //         document.getElementById('nombre').value = directiva.usuario.name;
    //         document.getElementById('correo').value = directiva.usuario.email;
    //         this.cargarDirectiva(directiva.directiva_id);
    //         this.cargarCargo(directiva.cargo_id);

    //         this.adminId = directiva.id;
    //     });
    // }

    // btnEstado() {
    //     Services.tabla.evento('#table_directiva', '.btn-estado', async (directiva) => {
    //         this.enviarDatos = {
    //             id: directiva.id,
    //             estado: directiva.estado
    //         };

    //         let respuesta = await this.consultaGeneral('actualizar el estado de la directiva', 'estado-directiva', { loader: 'progress' });
    //         if (!respuesta) return;
    //         Services.notificacion.success(respuesta.mensaje);
    //         this.consultarDatosTable();
    //     });
    // }

    // btnEliminar() {
    //     Services.tabla.evento('#table_directiva', '.btn-eliminar', async (directiva) => {
    //         Services.swal.fire({
    //             title: `Eliminar Integrante`,
    //             html: `¿Está seguro de eliminar el integrante <b>${directiva.usuario.name}?</b> </br> Esta acción no se puede deshacer.`,
    //             icon: 'question',
    //             showCancelButton: true,
    //             confirmButtonColor: '#3085d6',
    //             cancelButtonColor: '#d33',
    //             confirmButtonText: `Si, Eliminar`,
    //             cancelButtonText: 'Cancelar'
    //         }).then((result) => {
    //             if (result.isConfirmed) {
    //                 this.eliminar(directiva.id, directiva.usuario.email);
    //             }
    //         });
    //     });
    // }

    // async eliminar(id, correo) {
    //     this.enviarDatos = { id: id, correo: correo };

    //     let respuesta = await this.consultaGeneral('eliminar el integrante de la directiva', 'eliminar-directiva', { loader: 'progress' });
    //     if (!respuesta) return;
    //     Services.notificacion.success(respuesta.mensaje);
    //     this.consultarDatosTable();
    // }

    cargarTablaRol(datos) {
        Services.tabla.crear({
            id: '#table_roles',
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
                { data: 'descripcion' },
                {
                    data: 'created_at',
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
                    render: (data) => Services.accion.botones(data, {
                        extra: (datos) => {
                            return `
                            <button
                                type="button"
                                class="btn-asignar-permisos p-0-4 rounded-lg transition-colors transition-transform duration-150 active:scale-90"
                                data-id="${datos.id}"
                                data-tooltip="Asignar permisos">
                                <i data-lucide="user-key" class="w-4 h-4"></i>
                            </button>
                        `;
                        }
                    })
                }
            ],


            // exportar: ['excel', 'pdf']
        });

        this.btnEstado('roles');
        this.btnEditar('roles');
        this.btnAsignarPermisos('roles');
        this.btnEliminar('roles');

    }

    cargarTablaPermiso(datos) {
        Services.tabla.crear({
            id: '#table_permisos',
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
                {
                    data: 'created_at',
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

        this.btnEstado('permisos');
        this.btnEditar('permisos');
        this.btnEliminar('permisos');
    }

    btnEstado(tipo) {
        Services.tabla.evento('#table_' + tipo, '.btn-estado', async (item) => {
            this.enviarDatos = {
                id: item.id,
                estado: item.estado
            };
            this.ejecutarBotones('actualizar el estado del' + this.tabActual, 'estado-' + this.tabActual);
        });
    }

    btnEditar(tipo) {
        Services.tabla.evento('#table_' + tipo, '.btn-editar', (item) => {
            this.configuracionModal('editar');
            document.getElementById('nombre-' + this.tabActual).value = item.nombre;
            document.getElementById('descripcion-' + this.tabActual).value = item.descripcion;

            this.adminId = item.id;
        });
    }

    btnAsignarPermisos(tipo) {
        Services.tabla.evento('#table_' + tipo, '.btn-asignar-permisos', async (item) => {
            // this.configuracionModal('asignar-permisos');
            // document.getElementById('rol_id').value = item.id;

            // $('#asignar-permisos').modal('show');

            await this.consultarPermisos();
            window.dispatchEvent(new CustomEvent('open-modal', { detail: 'asignar-permisos' }));

            this.adminId = item.id;
                    Services.formulario.onClick('btn-cancelar-permiso', () => this.cerrarModal());

        });
    }

    async consultarPermisos() {

        if (this.permisosCargados) {
            this.cargarPermisos();
            return;
        }

        let respuesta = await this.consultaGeneral('consultar los permisos', 'consultar-permisos', { loader: 'progress' });
        if (!respuesta) return;
        this.permisosCargados = respuesta;

        this.cargarPermisos();
    }

    cargarPermisos() {
        let contenedor = document.getElementById('contenedor-permisos');
        if (!contenedor) return;

        contenedor.innerHTML = '';
        this.permisosCargados.forEach(permiso => {

            contenedor.innerHTML += `
                <label class="flex items-center gap-3 p-2 cursor-pointer hover:bg-gray-50">
                    
                    <input type="checkbox" name="permisos[]"  value="${permiso.id}"
                        class="w-5 h-5 rounded-md border-slate-300 text-[#1FA6A6] shadow-sm transition focus:ring-0 focus:outline-none focus:border-[#1FA6A6]">

                    <span class="text-sm text-slate-600">
                        ${permiso.nombre}
                    </span>
                </label>
            `;
        });
    }

    btnEliminar(tipo) {
        Services.tabla.evento('#table_' + tipo, '.btn-eliminar', async (item) => {
            Services.swal.fire({
                title: `Eliminar ${this.tabActual}`,
                html: `¿Está seguro de eliminar el ${this.tabActual} <b>${item.nombre}?</b> </br> Esta acción no se puede deshacer.`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: `Si, Eliminar`,
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.enviarDatos = { id: item.id };
                    this.ejecutarBotones('eliminar el' + this.tabActual, 'eliminar-' + this.tabActual);
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

    configuracionModal(tipo) {

        let configuracion = this.configuracionTag[this.tabActual];

        let titulo = document.getElementById(configuracion.titulo_id);
        let icono = document.getElementById('icono-guardar-'+this.tabActual);
        let mensajeLoading = document.getElementById('mensaje-loading');
        let spanGuardar = document.getElementById('span-guardar-'+this.tabActual);
        let tab_activo = this.tabActual.charAt(0).toUpperCase() + this.tabActual.slice(1).toLowerCase();

        if (tipo === 'nuevo') {
            titulo.textContent = configuracion.textoBoton;
            icono.setAttribute('data-lucide', 'save-check');
            mensajeLoading.textContent = 'Guardando información...';
            spanGuardar.textContent = 'Guardar '+tab_activo;

            this.adminId = null;


        } else {
            titulo.textContent = 'Editar ' + tab_activo;
            spanGuardar.textContent = 'Actualizar ' + tab_activo;
            icono.setAttribute('data-lucide', 'square-pen');
            mensajeLoading.textContent = 'Actualizando información...';
        }

        createIcons({ icons });

        Services.formulario.reiniciar(configuracion.modal_form);
        Services.drawer.abrir(configuracion.modal);
        new PasswordService().inicializar();
        this.enviarDatos = [];

        $('.btn-cancelar').off('click').on('click', (e) => {
            Services.drawer.cerrar(configuracion.modal);
        });

        Services.formulario.onSubmit(configuracion.modal_form, () => this.guardarActualizar(configuracion.modal_form, configuracion.modal));

    }


    async guardarActualizar(formId, nombre_modal) {

        Services.formulario.limpiarErroresCampos(formId);
        this.enviarDatos = Services.formulario.obtenerDatos(formId);

        if (this.tabActual === 'usuarios') {
            if (!this.validarContraseña()) return;
        }

        let ruta = 'crear';
        if (this.adminId) {
            this.enviarDatos.id = this.adminId;
            ruta = 'actualizar'
        }

        let respuesta = await this.consultaGeneral(ruta + ' la persona', ruta + '-' + this.tabActual, { loader: { type: 'drawer', id: nombre_modal } });
        if (!respuesta) return;

        Services.drawer.cerrar(nombre_modal);
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

    cerrarModal() {
        window.dispatchEvent(new CustomEvent('close-modal', { detail: 'asignar-permisos' }));
    }

}

const administracion = new Administracion();
administracion.cargarMetodos();

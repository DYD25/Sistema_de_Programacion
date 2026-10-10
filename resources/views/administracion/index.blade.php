<x-app-layout>

    <x-crud.header title="Panel Administrativo" subtitle="Gestione los Usuarios del Sistema">  
        <x-slot:icon>
            <x-heroicon-s-shield-check class="w-7 h-7 text-green-600" />
        </x-slot:icon>

        <x-slot:actions>
            <x-form.button-crear id="btn-crear" title="Crear Usuario" />
        </x-slot:actions>
       
    </x-crud.header>

    <div id="panel-body"> 
    <!-- TABS -->
        <!-- <div class="mb-6 mt-6 border-b border-slate-200">
            <nav class="flex gap-6" aria-label="Tabs">

                <x-tabs.button-tab tab="usuario" texto="Usuarios" activo="true">
                    <x-heroicon-o-user-group class="w-5 h-5" />
                </x-tabs.button-tab>
                
                <x-tabs.button-tab tab="rol" texto="Roles" activo="true">
                    <x-heroicon-o-shield-check class="w-5 h-5" />
                </x-tabs.button-tab>
                
                <x-tabs.button-tab tab="permiso" texto="Permisos" activo="true">
                    <x-heroicon-o-key class="w-5 h-5" />
                </x-tabs.button-tab>    

            </nav>
        </div>  -->

        <!-- ========================= -->
        <!-- TAB USUARIOS -->
        <!-- ========================= -->
        <div id="tab-usuario" class="">
            <x-crud.panel modal="crear-usuario">
                <x-slot:icon>
                    <x-heroicon-o-user-group class="w-6 h-6 text-green-600" />
                </x-slot:icon>

                @php
                    $columnas = [
                        ['contenido' => 'Nombre'],
                        ['contenido' => 'Correo electrónico'],
                        ['contenido' => 'Nom. Directiva'],
                        ['contenido' => 'Cargo'],
                        ['contenido' => 'Estado'],
                        ['contenido' => 'Acciones'],
                    ];
                @endphp

                <div class="overflow-x-auto">
                    <x-crud.table id="table_usuarios" :columnas="$columnas"/>
                </div>
            </x-crud.panel>

            <x-form.drawer modal="crear-usuario" title="Crear Usuario"  width="sm" formId="form-crear-usuario" textoGuardar="Usuario"> 
                <x-slot:icon>
                    <x-heroicon-s-user class="w-7 h-7 text-green-600" />
                </x-slot:icon>

                <div class="space-y-4">

                    <x-form.input label="Nombre " name="nombre_usuario" placeholder="Ej. Juan Pérez" :obligatorio="true"
                        maxlength="20">
                        <x-slot:icon>
                            <x-heroicon-s-users class="w-5" />
                        </x-slot:icon>
                    </x-form.input>
            
                    <x-form.select label="Directiva " name="id_directiva" placeholder="Ej. Alabanza" :obligatorio="true" maxlength="20" icon="building" />
                    <x-form.select label="Cargo" name="id_cargo" placeholder="Ej. Lider" :obligatorio="true" maxlength="50" icon="book-user" />
                    
                    <div class="md:col-span-2">
                        <x-form.input label="Correo electrónico" name="correo" placeholder="Ej. Prueba@example.com" :obligatorio="true">
                            <x-slot:icon>
                                <x-heroicon-s-envelope class="w-5" />
                            </x-slot:icon>
                        </x-form.input>
                    </div>

                    <div class="md:col-span-2 div-contrasena">
                        <x-form.input label="Contraseña" name="password" placeholder="••••••••" type="password" :obligatorio="true" autocomplete="new-password">
                            <x-slot:icon>
                                <x-heroicon-o-lock-closed class="w-5" />
                            </x-slot:icon>
                        </x-form.input>
                    </div>

                    <div class="md:col-span-2 div-contrasena">
                        <x-form.input label="Confirmar Contraseña" name="confirmar_password" placeholder="••••••••" type="password" autocomplete="new-password" :obligatorio="true">
                            <x-slot:icon>
                                <x-heroicon-s-lock-closed class="w-5" />
                            </x-slot:icon>
                        </x-form.input>
                    </div>
                </div>

            </x-form.drawer> 
        </div> 

        <!-- ========================= -->
        <!-- TAB ROLES  -->
        <!-- ========================= -->
        <div id="tab-rol" class="hidden">
            <x-crud.panel modal="crear-rol">
                <x-slot:icon>
                    <x-heroicon-o-shield-check class="w-6 h-6 text-green-600" />
                </x-slot:icon>

                @php
                    $columnasRoles = [
                        ['contenido' => 'Nombre'],
                        ['contenido' => 'Descripción'],
                        ['contenido' => 'N° Permisos'],
                        ['contenido' => 'Fecha Creación'],
                        ['contenido' => 'Estado'],
                        ['contenido' => 'Acciones'],
                    ];
                @endphp

                <div class="overflow-x-auto">
                    <x-crud.table id="table_roles"  :columnas="$columnasRoles"/>
                </div>

            </x-crud.panel>

            <x-form.drawer modal="crear-rol" titulo_id="titulo-rol" title="Crear Rol" icon_id="icono-rol"  width="sm" formId="form-rol" 
                    textoGuardar="Guardar Rol" spanGuardar="span-guardar-rol" iconoGuardar="icono-guardar-rol">

                <x-slot:icon>
                    <x-heroicon-s-shield-check class="w-7 h-7 text-green-600 hidden icono-rol" />
                    <x-heroicon-s-key class="w-7 h-7 text-green-600 " />
                </x-slot:icon>

                <div class="space-y-4">
                    <x-form.input label="Nombre " name="nombre-rol" placeholder="Ej. Administrador" :obligatorio="true" maxlength="20">
                        <x-slot:icon>
                            <x-heroicon-s-key class="w-5 h-5" />
                        </x-slot:icon>
                    </x-form.input>

                    <div class="md:col-span-2">
                        <x-form.input label="Descripción" name="descripcion-rol" placeholder="Ej. Administrador del sistema" :obligatorio="true" maxlength="100">
                            <x-slot:icon>
                                <x-heroicon-s-chat-bubble-left-ellipsis class="w-5" />
                            </x-slot:icon>
                        </x-form.input>
                    </div>
                </div>

            </x-form.drawer>
        </div>

        <x-form.modal title="Asignar permisos" modal="asignar-permisos" subtitle="Asigna los permisos al rol" formId="form-asignar-permisos" 
                    textoGuardar="Guardar Asignación" btnCancelar="btn-cancelar-permiso">
            
            <div class="border rounded-lg p-4">
                <div  id="contenedor-permisos" class="grid grid-cols-1 md:grid-cols-3 gap-3">
                </div>
            </div>
        </x-form.modal>
      
        <!-- ========================= -->
        <!-- TAB PERMISOS -->
        <!-- ========================= -->
        <div id="tab-permiso" class="hidden">
            <x-crud.panel modal="crear-permiso">
                <x-slot:icon>
                    <x-heroicon-o-shield-check class="w-6 h-6 text-green-600" />
                </x-slot:icon>

                @php
                    $columnasPermisos = [
                        ['contenido' => 'Nombre'],
                        ['contenido' => 'Descripción'],
                        ['contenido' => 'Fecha Creación'],
                        ['contenido' => 'Estado'],
                        ['contenido' => 'Acciones'],
                    ];
                @endphp

                <div class="overflow-x-auto">
                    <x-crud.table id="table_permisos"  :columnas="$columnasPermisos"/>
                </div>

            </x-crud.panel>

            <x-form.drawer modal="crear-permiso" titulo_id="titulo-permiso" title="Crear Permiso" icon_id="icono-permiso"  width="sm" formId="form-permiso" 
                    textoGuardar="Guardar Permiso" spanGuardar="span-guardar-permiso" iconoGuardar="icono-guardar-permiso">

                <x-slot:icon>
                    <x-heroicon-s-key class="w-7 h-7 text-green-600 icono-permiso" />
                </x-slot:icon>

                <div class="space-y-4">
                    <x-form.input label="Nombre " name="nombre-permiso" placeholder="Ej. Crea iglesias" :obligatorio="true" maxlength="20">
                        <x-slot:icon>
                            <x-heroicon-s-shield-check class="w-5 h-5 hidden icono-rol" />
                            <x-heroicon-s-key class="w-5 h-5 icono-permiso" />
                        </x-slot:icon>
                    </x-form.input>

                    <div class="md:col-span-2">
                        <x-form.input label="Descripción" name="descripcion-permiso" placeholder="Ej. Permiso para crear iglesias" :obligatorio="true" maxlength="100">
                            <x-slot:icon>
                                <x-heroicon-s-chat-bubble-left-ellipsis class="w-5" />
                            </x-slot:icon>
                        </x-form.input>
                    </div>
                </div>

            </x-form.drawer>
        </div>

    </div>  
</x-app-layout>

@vite('resources/js/administracion/administracion.js')

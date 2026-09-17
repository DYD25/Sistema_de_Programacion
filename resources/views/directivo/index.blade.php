<x-app-layout>

    <x-crud.header title="Directivo" subtitle="Gestione la Directivo">  
        <x-slot:icon>
            <x-heroicon-s-user-group class="w-7 h-7 text-green-600" />
        </x-slot:icon>
        <x-slot:actions>
            <x-form.button-crear id="btn-crear-directivo" title="Nueva Directivo"/>
        </x-slot:actions>
    </x-crud.header>

    <div id="panel-body">
         
        <x-crud.panel modal="crear-directivo">

            <x-slot:icon>
                <x-heroicon-o-user-group class="w-6 h-6 text-green-600" />
            </x-slot:icon>

            @php
            $columnas = [
                ['contenido' => 'Nombre'],
                ['contenido' => 'Nom. Directiva'],
                ['contenido' => 'Cargo'],
                ['contenido' => 'Correo electrónico'],
                ['contenido' => 'Estado'],
                ['contenido' => 'Acciones'],
                ];
            @endphp

            <div class="overflow-x-auto">
                <x-crud.table id="table_directivo" :columnas="$columnas" />
            </div>

        </x-crud.panel>

        <x-form.drawer modal="crear-directivo" title="Crear Directivo" subtitle="Complete la información" width="sm"
            formId="form-crear-directivo" textoGuardar="Directivo"> 

            <x-slot:icon>
                <x-heroicon-o-user class="w-7 h-7 text-green-600" />
            </x-slot:icon>

            <!-- Aquí van los inputs -->

            <div class="space-y-4">

                <x-form.input label="Nombre " name="nombre" placeholder="Ej. Juan Pérez" :obligatorio="true"
                    maxlength="20">
                    <x-slot:icon>
                        <x-heroicon-s-users class="w-5" />
                    </x-slot:icon>
                </x-form.input>

                <!-- @if(Auth::user()->iglesia_id) -->
                <!-- @endif --> 
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

                <div class="md:col-span-2 check">
                    <x-form.checkbox label="¿Cambiar contraseña?"  name="check_password" />
                </div>
                
            </div>

        </x-form.drawer>
    </div>

</x-app-layout>

@vite('resources/js/directivo/directivo.js')

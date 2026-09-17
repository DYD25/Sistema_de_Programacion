<x-app-layout>
    <x-crud.header title="Cargos" subtitle="Gestione los cargos">
        <x-slot:icon>
            <x-heroicon-s-user-group class="w-7 h-7 text-green-600" />
        </x-slot:icon>
        <x-slot:actions>
             <x-form.button-crear id="btn-crear-cargo" title="Nuevo Cargo"/>
        </x-slot:actions>
    </x-crud.header>

    <div id="panel-body">
         
        <x-crud.panel modal="crear-cargo">
            <x-slot:icon>
                <x-heroicon-o-user-group class="w-6 h-6 text-green-600" />
            </x-slot:icon>

            @php
            $columnas = [
                ['contenido' => 'Nombre'],
                ['contenido' => 'Descripción'],
                ['contenido' => 'Fecha de Creación'],
                ['contenido' => 'Estado'],
                ['contenido' => 'Acciones'],
                ];
            @endphp

            <div class="overflow-x-auto">
                <x-crud.table id="table_cargo" :columnas="$columnas" />
            </div>

        </x-crud.panel>

        <x-form.drawer modal="crear-cargo" title="Crear Cargo" subtitle="Complete la información" width="sm"
            formId="form-crear-cargo" textoGuardar="Cargo">

            <x-slot:icon>
                <x-heroicon-o-user-group class="w-7 h-7 text-green-600" />
            </x-slot:icon>

            <!-- Aquí van los inputs -->

            <div class="space-y-4">

                <x-form.input label="Nombre " name="nombre" placeholder="Ej. Lider" :obligatorio="true"
                    maxlength="20">
                    <x-slot:icon>
                        <x-heroicon-s-users class="w-5" />
                    </x-slot:icon>
                </x-form.input>

                <!-- @if(Auth::user()->iglesia_id) -->
                <!-- @endif --> 

                <div class="md:col-span-2">
                    <x-form.input label="Descripción" name="descripcion" placeholder="Ej. Lider de la iglesia Alabanza" :obligatorio="true" maxlength="100">
                        <x-slot:icon>
                            <x-heroicon-s-chat-bubble-left-ellipsis class="w-5" />
                        </x-slot:icon>
                    </x-form.input>
                </div>
                
            </div>

        </x-form.drawer>
    </div>

</x-app-layout>

@vite('resources/js/cargo/cargo.js')

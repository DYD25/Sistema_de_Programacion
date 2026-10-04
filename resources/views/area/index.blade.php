<x-app-layout>

    <x-crud.header title="Area" subtitle="Gestione las Areas o Ministerios">
        <x-slot:icon>
            <x-heroicon-s-user-group class="w-7 h-7 text-green-600" />
        </x-slot:icon>
        <x-slot:actions>
             <x-form.button-crear id="btn-crear-area" title="Nueva Area"/>    
        </x-slot:actions>
    </x-crud.header>

    <div id="panel-body">
         
        <x-crud.panel modal="crear-area">

            <x-slot:icon>
                <x-heroicon-o-user-group class="w-6 h-6 text-green-600" />
            </x-slot:icon>

            @php
            $columnas = [
                ['contenido' => 'Nombre'],
                ['contenido' => 'Descripción'],
                ['contenido' => 'Usar Grupos'],
                ['contenido' => 'Fecha de Creación'],   
                ['contenido' => 'Estado'],
                ['contenido' => 'Acciones'],
                ];
            @endphp

            <div class="overflow-x-auto">
                <x-crud.table id="table_areas" :columnas="$columnas" />
            </div>

        </x-crud.panel>

        <x-form.drawer modal="crear-area" title="Crear Area" subtitle="Complete la información" width="sm"
            formId="form-crear-area" textoGuardar="Area">

            <x-slot:icon>
                <x-heroicon-o-user class="w-7 h-7 text-green-600" />
            </x-slot:icon>

            <!-- Aquí van los inputs -->

            <div class="space-y-4">

                <x-form.input label="Nombre " name="nombre" placeholder="Ej. Comunicaciones" :obligatorio="true"
                    maxlength="20">
                    <x-slot:icon>
                        <x-heroicon-s-users class="w-5" />
                    </x-slot:icon>
                </x-form.input>

                <x-form.input label="Descripción " name="descripcion" placeholder="Ej. Ganar la Juventud " :obligatorio="true"
                    maxlength="50">
                    <x-slot:icon>
                        <x-heroicon-s-chat-bubble-left-ellipsis class="w-5" />
                    </x-slot:icon>
                </x-form.input>

                <x-form.checkbox label="¿Usar Grupos?" checked name="usa_grupo" />
                
            </div>

        </x-form.drawer>
    </div>

</x-app-layout>

@vite('resources/js/area/area.js')

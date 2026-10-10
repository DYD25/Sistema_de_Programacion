<x-app-layout>
    <x-crud.header title="Iglesias" subtitle="Gestione las iglesias">
        <x-slot:icon>
            <x-heroicon-s-user-group class="w-7 h-7 text-green-600" />
        </x-slot:icon>
        <x-slot:actions>
             <x-form.button-crear id="btn-crear-iglesia" title="Nueva iglesia"/>
        </x-slot:actions>
    </x-crud.header>

    <div id="panel-body">
         
        <x-crud.panel>
            <x-slot:icon>
                <x-heroicon-o-user-group class="w-6 h-6 text-green-600" />
            </x-slot:icon>

            @php
                $columnas = [
                    ['contenido' => 'Nombre'],
                    ['contenido' => 'Dirección'],
                    ['contenido' => 'Ciudad'],
                    ['contenido' => 'Fecha de Creación'],
                    ['contenido' => 'Estado'],
                    ['contenido' => 'Acciones'],
                ];
            @endphp

            <div class="overflow-x-auto">
                <x-crud.table id="table_iglesias" :columnas="$columnas" />
            </div>

        </x-crud.panel>

        <x-form.drawer drawerId="crear-iglesia" title="Crear Iglesia" formId="form-crear-iglesia" textoGuardar="Iglesia">

            <x-slot:icon>
                <x-heroicon-o-user-group class="w-7 h-7 text-green-600" />
            </x-slot:icon>

            <!-- Aquí van los inputs -->

            <div class="space-y-4">

                <x-form.input label="Nombre " name="nombre" placeholder="Ej. Santa Barbara" :obligatorio="true"
                    maxlength="20">
                    <x-slot:icon>
                        <x-heroicon-s-users class="w-5" />
                    </x-slot:icon>
                </x-form.input>

                <!-- @if(Auth::user()->iglesia_id) -->
                <!-- @endif --> 

                <div class="md:col-span-2">
                    <x-form.input label="Dirección" name="direccion" placeholder="Ej. Calle 123" :obligatorio="true" maxlength="100">
                        <x-slot:icon>
                            <x-heroicon-s-chat-bubble-left-ellipsis class="w-5" />
                        </x-slot:icon>
                    </x-form.input>
                </div>
                
                <div class="md:col-span-2">
                    <x-form.input label="Ciudad" name="ciudad" placeholder="Ej. Santa Barbara" :obligatorio="true" maxlength="100">
                        <x-slot:icon>
                            <x-heroicon-s-chat-bubble-left-ellipsis class="w-5" />
                        </x-slot:icon>
                    </x-form.input>
                </div>
            </div>
            
        </x-form.drawer>
    </div>

</x-app-layout>

@vite('resources/js/iglesia/iglesia.js')

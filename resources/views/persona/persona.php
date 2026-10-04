<x-app-layout>

    <x-crud.header title="Personas" subtitle="Gestiona las personas">
        <x-slot:icon>
            <x-heroicon-s-user-group class="w-7 h-7 text-green-600" />
        </x-slot:icon>
        <x-slot:actions>
            <div id="botones">
                <button id="btn-crear-persona"
                    class="inline-flex items-center gap-2 px-2 py-1 bg-green-600 hover:bg-green-700 text-white rounded-lg transition">
                    <x-heroicon-o-plus class="w-5 h-5" />
                    <span>Nueva Persona</span>
                </button>
            </div>
        </x-slot:actions>
    </x-crud.header>

    <div id="panel-body">
        <x-crud.panel modal="crear-persona">

            <x-slot:icon>
                <x-heroicon-o-user-group class="w-6 h-6 text-green-600" />
            </x-slot:icon>

            @php
            $columnas = [
            ['contenido' => 'Nombre'],
            ['contenido' => 'Nombre Whatsapp'],
            ['contenido' => 'Telefono'],
            ['contenido' => 'Estado'],
            ['contenido' => 'Acciones'],
            ];
            @endphp

            <div class="overflow-x-auto">
                <x-crud.table id="table_persona" :columnas="$columnas" />
            </div>

        </x-crud.panel>

        <x-form.drawer modal="crear-persona" title="Crear Persona" subtitle="Complete la información" width="sm"
            formId="form-crear-persona" textoGuardar="Persona">

            <x-slot:icon>
                <x-heroicon-o-user class="w-7 h-7 text-green-600" />
            </x-slot:icon>

            <!-- Aquí van los inputs -->

            <div class="space-y-4">

                <x-form.input label="Nombre " name="nombre" placeholder="Ej. Plablo Perez" :obligatorio="true"
                    maxlength="20">
                    <x-slot:icon>
                        <x-heroicon-s-user class="w-5" />
                    </x-slot:icon>
                </x-form.input>

                <x-form.input label="Nombre Whatsapp" name="nombre_whatsapp" placeholder="Ej. H.Plablo" :obligatorio="true"
                    maxlength="50">
                    <x-slot:icon>
                        <x-heroicon-s-user class="w-5" />
                    </x-slot:icon>
                </x-form.input>

                <div class="md:col-span-2">
                    <x-form.input label="Teléfono" name="telefono" placeholder="Ej. 3112001225" :obligatorio="true">
                        <x-slot:icon>
                            <x-heroicon-s-phone class="w-5" />
                        </x-slot:icon>
                    </x-form.input>
                </div>
            </div>

        </x-form.drawer>
    </div>

</x-app-layout>

@vite('resources/js/miembro/miembros.js')
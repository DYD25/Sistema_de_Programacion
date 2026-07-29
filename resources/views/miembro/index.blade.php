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
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-5">

            <x-cards.card-stat title="Personal Registrados" textoSuperior="Resumen"  valueId="card-total" value="0"
                subtitle="Registrados" topText="Agosto 2026">
                <div id="grafica-total-miembros" class="h-12"></div>
                <x-slot:footer>
                    <span id="crecimiento-miembros" class="text-green-600 text-xs font-semibold">
                            ▲ +0 este mes
                    </span>
                </x-slot:footer>
            </x-cards.card-stat>

            <x-cards.card-stat textoSuperior="Estado" title="Personal Activos" valueId="card-activos" value="0" subtitleId="porcentaje-activos" subtitle="">
                <div id="grafica-activos-miembro" class="h-12"></div>
                <x-slot:footer>
                    <span class="text-green-600 text-xs font-semibold">
                        ▲ %
                    </span>
                </x-slot:footer>
            </x-cards.card-stat>

            <x-cards.card-stat textoSuperior="Estado" title="Personal Inactivos" valueId="card-inactivos" value="0" subtitleId="porcentaje-inactivos" subtitle="">
                <div id="grafica-inactivos-miembro" class="h-12"></div>
                <x-slot:footer>
                    <span class="text-red-500 text-xs font-semibold">
                        ▼ %
                    </span>
                </x-slot:footer>
            </x-cards.card-stat>

            <x-cards.card-stat textoSuperior="Resumen" title="Estado General" valueId="card-general" value="0" subtitle="Miembros activos">
                <div id="grafica-radial-miembro" class="h-14"></div>
                <x-slot:footer>
                    <span id="estado-general" class="text-green-600 text-xs font-semibold">
                        Excelente
                    </span>
                </x-slot:footer>    
            </x-cards.card-stat>
        </div>

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
                    maxlength="20" />
                <x-form.input label="Nombre Whatsapp" name="nombre_whatsapp" placeholder="Ej. H.Plablo" :obligatorio="true"
                    maxlength="50" />

                <div class="md:col-span-2">
                    <x-form.input label="Teléfono" name="telefono" placeholder="Ej. 3112001225" :obligatorio="true">
                        <x-slot:icon>
                            <x-heroicon-o-phone class="w-5" />
                        </x-slot:icon>
                    </x-form.input>
                </div>
            </div>

        </x-form.drawer>
    </div>

</x-app-layout>

@vite('resources/js/miembro/miembros.js')
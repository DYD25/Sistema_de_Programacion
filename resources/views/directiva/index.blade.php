<x-app-layout>

    <div class="flex items-center justify-between mb-6">

        <div class="flex items-start gap-3">

            <div class="p-2 bg-green-100 rounded-lg">
                <x-heroicon-s-user-group class="w-8 h-8 text-green-600" />
            </div>

            <div>
                <h1 class="text-2xl font-bold text-gray-800">
                    Directivas
                </h1>

                <p class="text-gray-500 -mt-6">
                    Gestiona las Directivas
                </p>
            </div>

        </div>

        <button id="btn-crear-persona"
            class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition text-sm">

            <x-heroicon-o-plus class="w-5 h-5" />
            <span>Nueva Directiva</span>

        </button>
    </div>

    <div class="grid grid-cols-4 gap-6 mb-5">
        <x-cards.card-stat title="Total Personas" texto="Registradas" value="125">

            <x-slot:icon>
                <x-heroicon-o-user-group class="w-10 h-10 text-green-600" />
            </x-slot:icon>
        </x-cards.card-stat>

        <x-cards.card-stat title="Activos" texto="80% del total" value="125">

            <x-slot:icon>
                <x-heroicon-c-user-plus class="w-10 h-10 text-green-600" />
            </x-slot:icon>
        </x-cards.card-stat>

        <x-cards.card-stat title="Inactivos" texto="1% del total" value="100">

            <x-slot:icon>
                <x-heroicon-c-user-minus class="w-10 h-10 text-green-600" />
            </x-slot:icon>
        </x-cards.card-stat>

        <x-cards.card-stat title="Otros" texto="En desarrollo" value="10">

            <x-slot:icon>
                <x-heroicon-o-calendar-days class="w-10 h-10 text-green-600" />
            </x-slot:icon>
        </x-cards.card-stat>

    </div>

    <x-crud.panel modal="crear-directiva">

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

        <div class="tabla-scroll h-full">

            <x-crud.table id="table_personal" :columnas="$columnas" />
        </div>

    </x-crud.panel>

    <x-form.modal title="Crear Directiva" modal="crear-directiva" formId="form-crear-directiva" textoGuardar="Directiva">

        <input type="hidden" name="id_iglesia" value="1">

        <x-form.input label="Nombre" name="nombre" />

        <x-form.input label="Cargo" name="Cargo" />

        <x-form.checkbox label="Activo" name="estado" :checked="true" />

    </x-form.modal>

</x-app-layout>

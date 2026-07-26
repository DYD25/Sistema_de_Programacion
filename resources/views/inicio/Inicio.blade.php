<x-app-layout>
    <!-- Encabezado -->
    <div class="mb-6">

        <h1 class="text-3xl font-bold">
            Bienvenido, {{ Auth::user()->name }}
        </h1>

        <p class="text-gray-500">
            Aquí tienes un resumen general del sistema.
        </p>

    </div>

    <!-- Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-6">

        <x-cards.card-stat title="Ministerios" texto="Activos" value="5">

            <x-slot:icon>
                <x-heroicon-o-user-group class="w-10 h-10 text-green-600" />
            </x-slot:icon>

        </x-cards.card-stat>

        <x-cards.card-stat title="Miembros" texto="Registrados" value="125">

            <x-slot:icon>
                <x-heroicon-o-users class="w-10 h-10 text-green-600" />
            </x-slot:icon>

        </x-cards.card-stat>

        <x-cards.card-stat title="Programaciones" texto="Este mes" value="18">

            <x-slot:icon>
                <x-heroicon-o-calendar-days class="w-10 h-10 text-green-600" />
            </x-slot:icon>

        </x-cards.card-stat>

        <x-cards.card-stat title="Servidores" texto="Disponibles" value="62">

            <x-slot:icon>
                <x-heroicon-o-user-plus class="w-10 h-10 text-green-600" />
            </x-slot:icon>

        </x-cards.card-stat>

    </div>

    <!-- Gráficas -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-6">

        <x-cards.card title="Estado de los miembros">
            <div id="grafica-miembros-inicio" class="h-10"></div>
        </x-cards.card>

        <x-cards.card title="Crecimiento de miembros">

            <div id="grafica-crecimiento" class="h-10"></div>

        </x-cards.card>

        <x-cards.card title="Miembros por ministerio">

            <div id="grafica-ministerios" class="h-10"></div>

        </x-cards.card>

        <x-cards.card title="Cumplimiento de Programación">

            <div id="grafica-cumplimiento" class="h-10"></div>

        </x-cards.card>

    </div>

    <!-- Línea -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-6">

        <x-cards.card title="Participación por ministerio">
            <div id="grafica-pie-ministerios-inicio" class="h-80"></div>
        </x-cards.card>

        <x-cards.card title="Distribución de actividades">
            <div id="grafica-polar-actividades" class="h-80"></div>
        </x-cards.card>

        <x-cards.card title="Crecimiento de miembros">
            <div id="grafica-area-miembros" class="h-80"></div>
        </x-cards.card>
    </div>

    <!-- Información -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        <x-cards.card title="Programación de la semana">

            <div class="space-y-3">

                <div class="flex justify-between border-b pb-2">
                    <span>Culto de Oración</span>
                    <span class="text-gray-500">Martes</span>
                </div>

                <div class="flex justify-between border-b pb-2">
                    <span>Ensayo de Alabanza</span>
                    <span class="text-gray-500">Jueves</span>
                </div>

                <div class="flex justify-between border-b pb-2">
                    <span>Culto General</span>
                    <span class="text-gray-500">Sábado</span>
                </div>

            </div>

        </x-cards.card>

        <x-cards.card title="Últimos miembros registrados">

            <div class="space-y-3">

                <div class="flex justify-between border-b pb-2">
                    <span>Juan Pérez</span>
                    <span class="text-gray-500">Hoy</span>
                </div>

                <div class="flex justify-between border-b pb-2">
                    <span>Ana López</span>
                    <span class="text-gray-500">Ayer</span>
                </div>

                <div class="flex justify-between border-b pb-2">
                    <span>Carlos Gómez</span>
                    <span class="text-gray-500">Hace 3 días</span>
                </div>

            </div>

        </x-cards.card>

        <x-cards.card title="Últimos miembros registrados">

            <div class="space-y-3">

                <div class="flex justify-between border-b pb-2">
                    <span>Juan Pérez</span>
                    <span class="text-gray-500">Hoy</span>
                </div>

                <div class="flex justify-between border-b pb-2">
                    <span>Ana López</span>
                    <span class="text-gray-500">Ayer</span>
                </div>

                <div class="flex justify-between border-b pb-2">
                    <span>Carlos Gómez</span>
                    <span class="text-gray-500">Hace 3 días</span>
                </div>

            </div>

        </x-cards.card>

    </div>

</x-app-layout>

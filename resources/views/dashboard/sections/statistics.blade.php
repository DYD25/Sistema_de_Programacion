<x-form.section
    title="Resumen general"
    subtitle="Estado actual del sistema">

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

        <x-cards.card-stat
            title="Encuestas"
            subtitle="Activas"
            value="2">

            <x-heroicon-o-clipboard-document-list class="w-10 h-10 text-green-600" />

        </x-cards.card-stat>


        <x-cards.card-stat
            title="Miembros"
            subtitle="Registrados"
            value="125">

            <x-heroicon-o-users class="w-10 h-10 text-green-600" />

        </x-cards.card-stat>


        <x-cards.card-stat
            title="Servidores"
            subtitle="Activos"
            value="62">

            <x-heroicon-o-user-group class="w-10 h-10 text-green-600" />

        </x-cards.card-stat>


        <x-cards.card-stat
            title="Programaciones"
            subtitle="Este mes"
            value="18">

            <x-heroicon-o-calendar-days class="w-10 h-10 text-green-600" />

        </x-cards.card-stat>


    </div>

</x-form.section>
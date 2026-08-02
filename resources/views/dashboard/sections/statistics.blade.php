<x-form.section title="" subtitle="">

    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">

        <x-cards.card-stat title="Encuestas" subtitle="Activas" value="2" trend="+18%">

            <x-slot:chart>

                <x-charts.sparkline color="#21783E" />

            </x-slot:chart>

        </x-cards.card-stat>

        <x-cards.card-stat title="Miembros" subtitle="Registradosxxxx" value="125" trend="+5%">

            <x-slot:chart>

                <x-charts.sparkline color="#1FA6A6" />

            </x-slot:chart>

        </x-cards.card-stat>

        <x-cards.card-stat title="Servidores" subtitle="Disponibles" value="62" trend="+12%">

            <x-slot:chart>

                <x-charts.sparkline color="#21783E" />

            </x-slot:chart>

        </x-cards.card-stat>

        <x-cards.card-stat title="Programaciones" subtitle="Este mes" value="18" trend="+9%">

            <x-slot:chart>

                <x-charts.sparkline color="#1FA6A6" />

            </x-slot:chart>

        </x-cards.card-stat>

    </div>

</x-form.section>

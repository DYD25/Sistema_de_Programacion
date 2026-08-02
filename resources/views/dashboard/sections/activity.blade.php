<x-form.section
    title=""
    subtitle="">

    <x-cards.card>

        <x-slot:header>

            <div class="flex items-center justify-between">

                <h3 class="font-semibold text-slate-800">

                    Última actividad

                </h3>

            </div>

        </x-slot:header>

        <div class="px-5">

            <x-lists.activity-item
                title="Carlos Mosquera"
                description="Respondió la encuesta del culto del sábado."
                time="Hace 5 minutos"
                color="green"/>

            {{-- <x-lists.activity-item
                title="Ana Pérez"
                description="Actualizó su disponibilidad."
                time="Hace 18 minutos"
                color="yellow"/> --}}

            <x-lists.activity-item
                title="Sistema"
                description="Se generó una nueva programación."
                time="Hace 1 hora"
                color="blue"/>

            <x-lists.activity-item
                title="15 servidores"
                description="Aún no responden la encuesta."
                time="Hace 3 horas"
                color="red"/>

        </div>

    </x-cards.card>

</x-form.section>
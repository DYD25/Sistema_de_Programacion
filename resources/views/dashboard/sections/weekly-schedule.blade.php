<x-form.section title="" subtitle="">

    <x-cards.card>

        <x-slot:header>

            <div class=" flex items-center justify-between">

                <div class="flex items-center gap-3">

                    <div class="flex h-5 w-5 items-center justify-center rounded-xl bg-green-50">
                        <x-heroicon-o-calendar-days class="w-6 h-6 text-[#21783E]" />
                    </div>

                    <div>
                        <h3 class="font-semibold text-slate-800">
                            Programación de la semana
                        </h3>
                    </div>

                </div>

    
                 <a href="#"
                    class=" text-sm inline-flex items-center gap-2 font-medium text-[#21783E] hover:text-[#1FA6A6]">

                   Ver calendario

                    <x-heroicon-o-arrow-right class="w-4 h-4" />

                </a>

            </div>

        </x-slot:header>

        <div class="divide1-y">

            <x-lists.schedule-item day="MAR" date="29" title="Culto de Oración" time="7:00 PM - 8:30 PM"
                status="Completo" color="green" />

            <x-lists.schedule-item day="JUE" date="31" title="Ensayo de Alabanza" time="7:30 PM - 9:00 PM"
                status="2 vacantes" color="yellow" />

            <x-lists.schedule-item day="SAB" date="02" title="Culto General" time="6:00 PM - 8:00 PM"
                status="En proceso" color="blue" />

            <x-lists.schedule-item day="DOM" date="03" title="Escuela Dominical" time="9:00 AM - 10:30 AM"
                status="Pendiente" color="purple" last />

        </div>

    </x-cards.card>

</x-form.section>

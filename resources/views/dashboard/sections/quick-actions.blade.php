<x-form.section
    title="Acciones rápidas"
    subtitle="Accede rápidamente a las funciones más utilizadas.">

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

        <x-cards.card>

            <a href="#" class="flex flex-col items-center justify-center py-6 text-center group">

                <div class="w-14 h-14 rounded-2xl bg-green-100 flex items-center justify-center group-hover:bg-green-600 transition">

                    <x-heroicon-o-calendar-days class="w-7 h-7 text-green-600 group-hover:text-white" />

                </div>

                <h3 class="mt-4 font-semibold text-slate-700">
                    Nueva programación
                </h3>

            </a>

        </x-cards.card>

        <x-cards.card>

            <a href="#" class="flex flex-col items-center justify-center py-6 text-center group">

                <div class="w-14 h-14 rounded-2xl bg-cyan-100 flex items-center justify-center group-hover:bg-cyan-600 transition">

                    <x-heroicon-o-clipboard-document-list class="w-7 h-7 text-cyan-600 group-hover:text-white" />

                </div>

                <h3 class="mt-4 font-semibold text-slate-700">
                    Nueva encuesta
                </h3>

            </a>

        </x-cards.card>

        <x-cards.card>

            <a href="#" class="flex flex-col items-center justify-center py-6 text-center group">

                <div class="w-14 h-14 rounded-2xl bg-amber-100 flex items-center justify-center group-hover:bg-amber-500 transition">

                    <x-heroicon-o-user-plus class="w-7 h-7 text-amber-600 group-hover:text-white" />

                </div>

                <h3 class="mt-4 font-semibold text-slate-700">
                    Registrar miembro
                </h3>

            </a>

        </x-cards.card>

        <x-cards.card>

            <a href="#" class="flex flex-col items-center justify-center py-6 text-center group">

                <div class="w-14 h-14 rounded-2xl bg-violet-100 flex items-center justify-center group-hover:bg-violet-600 transition">

                    <x-heroicon-o-document-chart-bar class="w-7 h-7 text-violet-600 group-hover:text-white" />

                </div>

                <h3 class="mt-4 font-semibold text-slate-700">
                    Reportes
                </h3>

            </a>

        </x-cards.card>

    </div>

</x-form.section>
<x-form.section title="" subtitle="">

    <x-cards.card>

        <x-slot:header>

            <div class=" flex items-center justify-between">

                <div class="flex items-center gap-3">

                    <div class="flex h-5 w-5 items-center justify-center rounded-xl bg-green-50">
                        <x-heroicon-o-chart-bar class="w-6 h-6 text-[#21783E]" />
                    </div>

                    <div>
                        <h3 class="font-semibold text-slate-800">
                            Estado de la encuesta
                        </h3>
                    </div>

                </div>
                <a href="#"
                    class="text-sm inline-flex items-center gap-2 font-medium text-[#21783E] hover:text-[#1FA6A6]">

                    Ver detalles completos

                    <x-heroicon-o-arrow-right class="w-4 h-4" />

                </a>

            </div>

        </x-slot:header>

        <div class="grid grid-cols-1 lg:grid-cols-[300px_1fr] gap-8 items-center">

            {{-- Gráfico --}}
            <div class="flex justify-center">
                <div class="relative w-56 h-56">

                    <svg viewBox="0 0 42 42" class="w-full h-full -rotate-90">

                        {{-- Fondo --}}
                        <circle cx="21" cy="21" r="15.915" fill="none" stroke="#E5E7EB"
                            stroke-width="3" />

                        {{-- Respondieron (67%) --}}
                        <circle cx="21" cy="21" r="15.915" fill="none" stroke="#21783E"
                            stroke-width="3" stroke-dasharray="67 33" stroke-linecap="round" />

                    </svg>

                    {{-- Centro --}}
                    <div class="absolute inset-0 flex flex-col items-center justify-center">

                        <span class="text-4xl font-bold text-slate-900">
                            67%
                        </span>

                        <span class="text-sm text-slate-500">
                            Completado
                        </span>

                    </div>

                </div>

            </div>


            {{-- Información --}}
            <div class="space-y-6">

                <div class="flex items-start justify-between mt-5">
                    <div>
                        <div class="flex items-center gap-3">
                            <span class="h-3 w-3 rounded-full bg-[#21783E]"></span>

                            <p class="font-medium text-slate-700">
                                Respondieron
                            </p>
                        </div>

                        <div class=" ml-6 flex items-center gap-1">
                            <p class="text-2xl font-bold text-slate-900">
                                84
                            </p>
                            <span class="text-sm font-medium text-slate-500 self-end pl-3 pb-1.5">
                                (67%)
                            </span>
                        </div>

                    </div>

                </div>

                <div class="flex items-center justify-between mt-5">

                    <div>

                        <div class="flex items-center gap-3">

                            <span class="h-3 w-3 rounded-full bg-[#F59E0B]"></span>

                            <p class="text-slate-600">
                                Pendientes
                            </p>

                        </div>

                        <div class="ml-6 flex items-center gap-1">

                            <p class="text-2xl font-bold text-slate-900">
                                42
                            </p>

                            <span class="self-end pb-1.5 pl-3 text-sm font-medium text-slate-500">
                                (33%)
                            </span>

                        </div>

                    </div>

                </div>

                {{-- Total --}}
                <div class="border-t pt-2">

                    <p class="text-slate-500">
                        Total de servidores
                    </p>

                    <p class="text-3xl font-bold text-slate-900">
                        126
                    </p>

                </div>

            </div>



        </div>

    </x-cards.card>

</x-form.section>

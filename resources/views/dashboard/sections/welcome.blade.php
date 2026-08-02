<section>
    <div
        class="border-l-4 border-[#21783E] relative overflow-hidden rounded-xl bg-white mb-5 px-8 py-6 text-black shadow-xl flex flex-col lg:flex-row items-center gap-6">

        {{-- Icono --}}
        <div
            class="flex h-32 w-32 flex-shrink-0 items-center justify-center rounded-2xl bg-gradient-to-br from-[#21783E] to-[#1FA6A6] shadow-lg">

            <x-heroicon-s-chart-bar class="w-20 h-20 text-white" />
        </div>

        {{-- Contenido principal --}}
        <div class="max-w-4xl flex-1">

            <div class="">
                <span
                    class="inline-flex items-center gap-2 rounded-full bg-green-100 px-3 py-1 text-sm font-medium backdrop-blur text-green-700">

                    <span class="w-2 h-2 rounded-full bg-green-300"></span>
                    Encuesta activa
                </span>

                <h1 class="mt-2 text-2xl font-bold">
                    Programación semana 2 de Agosto 2026
                </h1>

                <p class="text-grey-100 leading-relaxed text-sm">
                    La encuesta correspondiente a la programación de esta semana, se
                    encuentra activa.
                </p>
            </div>

            <div class="mt-3">
                <div class="flex items-center gap-8">
                    <div>
                        <span class="text-3xl text-green-700 font-bold">
                            67%
                        </span>
                        <div class="pb-2 text-grey-100">
                            completado
                        </div>
                    </div>
                    <!-- Vertical separator line -->
                    <div class="h-16 w-px bg-gray-300"></div>
                    <div class="flex-1">
                        <span class="mb-3 "><strong class="text-md font-bold">84</strong> de <strong
                                class="text-md font-bold">100</strong> completado</span>
                        <x-progress.bar value="67" color="green" height="h-3" />
                    </div>
                </div>

            </div>
        </div>

        {{-- Estadísticas --}}
            <div class=" border-l-2 border-gray-300 pl-6 lg:ml-auto">
            <div class=" gap-1">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0">
                        <x-heroicon-o-users class="w-10 h-10 text-green-700" />
                    </div>
                    <div>
                        <p class="text-2xl font-bold">
                            84
                        </p>
                        <p class="text-sm font-bold">
                            Respondieron

                        </p>
                        <p class="text-xs">
                            33% del total
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-full bg-yellow-50 flex items-center justify-center flex-shrink-0">
                        <x-heroicon-o-clock class="w-10 h-10 text-yellow-300" />
                    </div>
                    <div class="mt-3">
                        <p class="text-2xl font-bold">
                            42
                        </p>
                        <p class="text-sm font-bold">
                            Pendientes
                        </p>
                        <p class="text-xs">

                            33% del total
                        </p>
                    </div>
                </div>


            </div>
        </div>

    </div>

</section>

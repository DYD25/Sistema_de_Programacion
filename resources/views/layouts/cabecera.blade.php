<header id="header"
    class="fixed top-0 right-0 left-52 h-16 bg-white shadow-sm flex items-center justify-between px-6 z-50 transition-all duration-300">

    <div class="flex items-center gap-5">

        <button id="btn-menu" class="p-2 rounded-lg hover:bg-gray-100 transition" data-tooltip="Menú">

            <x-heroicon-o-bars-3 class="w-6 h-6" />

        </button>

        <div class="border-l border-slate-200 h-8"></div>

        <div>

            <h2 class="text-base font-semibold text-slate-800">

                Buenas noches,
                <span class="text-[#21783E]">

                    {{ explode(' ', Auth::user()->name)[0] }}

                </span>

            </h2>

            <p class="text-xs text-slate-500">

                {{ now()->translatedFormat('l, d \\d\\e F \\d\\e Y') }}

            </p>

        </div>

    </div>

    <div class="flex items-center gap-4">

        <div class="relative w-10 h-10  flex items-center justify-center">
            <x-heroicon-o-bell class="w-6 h-6 text-gray-500" />
            <span class="absolute top-1 right-1 w-2.5 h-2.5 bg-green-700 rounded-full"></span>
        </div>

        
    </div>

</header>

<header id="header"
class="fixed top-0 right-0 left-52 h-16 bg-white shadow-sm flex items-center justify-between px-6 z-50 transition-all duration-300">

    <div class="flex items-center gap-4">
        <button id="btn-menu" class="p-2 rounded-lg hover:bg-gray-100" data-tooltip=" Menú">
            <x-heroicon-o-bars-3 class="w-6 h-6" />
        </button>
    </div>

    <div class="flex items-center gap-4">

        <div class="relative w-10 h-10  flex items-center justify-center">
            <x-heroicon-o-bell class="w-6 h-6 text-gray-500" />
            <span class="absolute top-1 right-1 w-2.5 h-2.5 bg-green-700 rounded-full"></span>
        </div>

        <div class="w-10 h-10 rounded-full bg-gray-50 border border-gray-300 flex items-center justify-center">
            <x-heroicon-s-user class="w-6 h-6 text-gray-500" />
        </div>

    </div>

</header>

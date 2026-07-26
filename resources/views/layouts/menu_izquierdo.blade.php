<aside id="sidebar"
    class="fixed left-0 top-0 w-52 h-screen flex flex-col bg-green-900 text-white transition-all duration-300">
    <div class="flex items-center gap-3 p-6 border-b border-green-800">

        <div class="flex-shrink-0">
            <x-heroicon-s-squares-plus class="w-10 h-10 text-white" />
        </div>

        <div class="logo">
            <h1 class="text-lg font-bold leading-tight">
                Sistema de Programación
            </h1>

            <p class="text-sm text-green-200">
                Ministerial
            </p>
        </div>
    </div>

    <x-form.select-iglesia :iglesias="$iglesias" :iglesiaSeleccionada="$iglesiaSeleccionada" />

    <nav class="flex-1 overflow-y-auto mt-2 mb-20">

        <x-menu.item :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            <x-slot:icon>
                <x-heroicon-s-home class="w-5 h-5" />
            </x-slot:icon>
            Inicio
        </x-menu.item>

        <x-menu.item :href="route('miembros.index')" :active="request()->routeIs('miembros.index')">
            <x-slot:icon>
                <x-heroicon-s-users class="w-5 h-5" />
            </x-slot:icon>
            Personal
        </x-menu.item>

        <x-menu.item :href="route('directivas.index')" :active="request()->routeIs('directivas.index')">
            <x-slot:icon>
                <x-heroicon-s-user-group class="w-5 h-5" />
            </x-slot:icon>
            Directivas
        </x-menu.item>

        <x-menu.item :href="route('directivas.index')" :active="request()->routeIs('directivas.index')">
            <x-slot:icon>
                <x-heroicon-s-calendar-days class="w-5 h-5" />
            </x-slot:icon>
            Programaciones
        </x-menu.item>

        <x-menu.item :href="route('directivas.index')" :active="request()->routeIs('directivas.index')">
            <x-slot:icon>
                <x-heroicon-s-flag class="w-5 h-5" />
            </x-slot:icon>
            Eventos
        </x-menu.item>

        <x-menu.item :href="route('directivas.index')" :active="request()->routeIs('directivas.index')">
            <x-slot:icon>
                <x-heroicon-s-clock class="w-5 h-5" />
            </x-slot:icon>
            Reportes
        </x-menu.item>


        <x-menu.item :href="route('directivas.index')" :active="request()->routeIs('directivas.index')">
            <x-slot:icon>
                <x-heroicon-s-document-text class="w-5 h-5" />
            </x-slot:icon>
            Notificaciones
        </x-menu.item>


        <x-menu.item :href="route('directivas.index')" :active="request()->routeIs('directivas.index')">
            <x-slot:icon>
                <x-heroicon-s-cog-6-tooth class="w-5 h-5" />
            </x-slot:icon>
            Configuración
        </x-menu.item>

    </nav>

    <div class="absolute bottom-0 left-0 w-full border-t bg-green-950 border-green-800 p-4">
        <div id="usuario-sidebar" class="flex items-center ml-2 gap-1">
            <div
                class="w-10 h-10 min-w-10 min-h-10 flex-shrink-0 rounded-full bg-green-700 flex items-center justify-center text-white font-semibold">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>

            <div class="user-info flex-1">
                <p class="text-sm font-semibold text-white">
                    {{ Auth::user()->name }}
                </p>

                <p class="text-xs text-green-200">
                    Administrador
                </p>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="p-1 rounded-lg text-green-200 hover:bg-green-700 hover:text-white"
                    data-tooltip="Cerrar sesión">
                    <x-heroicon-o-arrow-right-on-rectangle class="w-5 h-5" />
                </button>
            </form>
        </div>
    </div>
</aside>

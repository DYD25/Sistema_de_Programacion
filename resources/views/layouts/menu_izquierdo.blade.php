<aside id="sidebar"
    class="fixed left-0 top-0 w-15 h-screen flex flex-col bg-gradient-to-r from-[#21783E] via-[#1F9A72] to-[#1FA6A6] text-white transition-all duration-300">
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

        <x-menu.item :href="route('personas-vista.index')" :active="request()->routeIs('personas-vista.index')">
            <x-slot:icon>
                <x-heroicon-s-users class="w-5 h-5" />
            </x-slot:icon>
            Personas
        </x-menu.item>


        <x-menu.item :href="route('cargos.index')" :active="request()->routeIs('cargos.*')">
            <x-slot:icon>
                <x-heroicon-s-scale class="w-4 h-4" />
            </x-slot:icon>
            Cargos
        </x-menu.item>

        <x-menu.item :href="route('directivas.index')" :active="request()->routeIs('directivas.index')">
            <x-slot:icon>
                <x-heroicon-s-user-group class="w-5 h-5" />
            </x-slot:icon>
            Directiva
        </x-menu.item>

 
        <!--        <x-menu.item :href="route('directivas.index')" :active="request()->routeIs('directivas.index')">
            <x-slot:icon>
                <x-heroicon-s-calendar-days class="w-5 h-5" />
            </x-slot:icon>
            Encuesta
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
        </x-menu.item> -->

        <div x-data="{ open: {{ request()->routeIs('administracion.*','iglesias.*','areas.*','personas-general.*') ? 'true' : 'false' }} }">

            <div @click="open = !open" class="relative">

                <x-menu.item href="javascript:void(0);" :active="request()->routeIs('roles.*')">
                    <x-slot:icon>
                        <x-heroicon-s-cog-6-tooth class="w-5 h-5" />
                    </x-slot:icon>
                    Configuración
                </x-menu.item>

                <x-heroicon-s-chevron-right class="absolute right-3 top-1/2 w-4 h-4 -translate-y-1/2 transition-transform duration-200" ::class="{ 'rotate-90': open }" />
            </div>

            <div x-show="open" x-collapse class="ml-6 mt-0 space-y-1">

                <x-menu.item :href="route('iglesias.index')" :active="request()->routeIs('iglesias.*')">
                    <x-slot:icon>
                        <x-heroicon-s-building-office class="w-4 h-4" />
                    </x-slot:icon>
                    Iglesias
                </x-menu.item>

                <x-menu.item :href="route('areas.index')" :active="request()->routeIs('areas.*')">
                    <x-slot:icon>
                        <x-heroicon-s-tag class="w-4 h-4" />
                    </x-slot:icon>
                    Areas/Ministerios
                </x-menu.item>

                <x-menu.item :href="route('personas-general.index')" :active="request()->routeIs('personas-general.*')">
                    <x-slot:icon>
                        <x-heroicon-s-user-group class="w-5 h-5" />
                    </x-slot:icon>
                    Personas General
                </x-menu.item>

                <x-menu.item :href="route('administracion.index')" :active="request()->routeIs('administracion.*')">
                    <x-slot:icon>
                        <x-heroicon-s-shield-check class="w-4 h-4" />
                    </x-slot:icon>
                    Administración
                </x-menu.item>

            </div>
        </div>
    </nav>

    <div class="absolute bottom-0 left-0 w-full border-t from-[#166534]  hover:to-[#1F9A72] hover:text-white p-5">
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
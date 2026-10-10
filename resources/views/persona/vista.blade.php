<x-app-layout>

    <x-crud.header title="Panel de Administración de Personas" subtitle="Gestione las Directivas, Personas y Grupos del Sistema">  
        <x-slot:icon>
            <x-heroicon-s-users class="w-7 h-7 text-green-600" />
        </x-slot:icon>

        <x-slot:actions>
            <x-form.button-crear id="btn-crear" title="Crear" />
        </x-slot:actions>
       
    </x-crud.header>

    <div id="panel-body"> 
    <!-- TABS -->
    <x-tabs.tab
        id="personas-tabs"
        :tabs="[
            [
                'id' => 'directivas',
                'texto' => 'Directivas',
                'icon' => 'heroicon-o-user',
                'ruta' => route('directivas.index'),
            ],
            [
                'id' => 'personas',
                'texto' => 'Personas',
                'icon' => 'heroicon-o-users',
                'ruta' => route('cargos.index'),
            ],
            [
                'id' => 'grupos',
                'texto' => 'Grupos',
                'icon' => 'heroicon-o-user-group',
                'ruta' => route('cargos.index'),
            ],
            
        ]"
        activo="directivas"/>

    </div>  
</x-app-layout>

@vite('resources/js/tabs/tab.js')


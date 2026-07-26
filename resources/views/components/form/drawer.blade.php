@props([
    'modal',
    'title',
    'subtitle' => 'Complete la información requerida',
    'icon' => 'user',
    'formId' => null,
    'textoGuardar' => 'Guardar',
    'width' => 'md',
])

@php
    $widths = [
        'sm' => 'md:w-[420px]',
        'md' => 'md:w-[520px]',
        'lg' => 'md:w-[700px]',
        'xl' => 'md:w-[900px]',
    ];
    $drawerWidth = $widths[$width] ?? $widths['md'];
@endphp

<div x-data="{
    open: false,
    loading: false,

    cerrar() {
        this.open = false;
        document.body.classList.remove('overflow-hidden');
    },

    init() {
        window.addEventListener('drawer-open', (e) => {
            if (e.detail.id === '{{ $modal }}') {
                this.open = true;
                document.body.classList.add('overflow-hidden');
            }
        });

        window.addEventListener('drawer-close', (e) => {
            if (e.detail.id === '{{ $modal }}') {
                this.cerrar();
            }
        });


        window.addEventListener('drawer-loading', (e) => {

    if (e.detail.id === '{{ $modal }}') {
        this.loading = true;
    }

});

window.addEventListener('drawer-loaded', (e) => {

    if (e.detail.id === '{{ $modal }}') {
        this.loading = false;
    }

});





    }
}" x-show="open" @keydown.escape.window="if(open) cerrar()" id="{{ $modal }}"
    class="fixed inset-0 z-50" 
    x-cloak
     x-bind:class="{
        'pointer-events-none': !open,
        'pointer-events-auto': open
    }">

    <!-- Fondo -->
    <div
     x-show="open"
    x-transition.opacity
     class="absolute inset-0 bg-black/40">
    </div>

    <!-- Drawer -->
    <div x-show="open" x-transition:enter="transform transition ease-in-out duration-500"
        x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
        x-transition:leave="transform transition ease-in-out duration-500" x-transition:leave-end="translate-x-full"
        x-transition:leave-start="translate-x-0"
        class="absolute top-0 right-0 h-full w-full bg-white shadow-2xl {{ $drawerWidth }} bg-white shadow-2xl overflow-hidden">

        <div x-show="loading" x-transition.opacity
            class="absolute inset-0 z-50 bg-white/70 backdrop-blur-sm flex items-center justify-center">
            <div class="text-center">
                <div class="animate-spin rounded-full h-12 w-12 border-4 border-green-600 border-t-transparent mx-auto">
                </div>
                <p id="mensaje-loading" class="mt-4 text-gray-600 font-medium">
                   
                </p>
            </div>
        </div>


        <form id="{{ $formId }}" autocomplete="off" class="flex flex-col h-full">

            <!-- Header -->
            <div class="border-b p-3">
                <div class="flex justify-between">

                    <div class="flex items-start gap-3">
                        <div class="bg-green-100 rounded-lg p-2 flex-shrink-0">
                            {{ $icon ?? '' }}
                        </div>

                        <div>
                            <h2 id='titulo-modal' class="text-lg font-semibold">
                                {{ $title }}
                            </h2>
                            <p id='subtitle-modal' class="text-sm text-gray-500 -mt-6">
                                {{ $subtitle }}
                            </p>
                        </div>
                    </div>

                    <div class="flex justify-end items-start">

                        <button type="button" @click="cerrar()"
                            class="p-1 flex items-center justify-center rounded-lg text-gray-400 hover:bg-gray-100 hover:text-gray-700 transition">

                            <x-heroicon-o-x-mark class="w-8 h-8" />

                        </button>
                    </div>
                </div>
            </div>

            <!-- Body -->
            <div class="flex-1 overflow-y-auto p-6">
                {{ $slot }}
            </div>

            <!-- Footer -->
            <div class="border-t pt-1 p-3 flex justify-center gap-2">
                <x-form.button-cancel :modal="$modal" />
                <x-form.button-save :texto="$textoGuardar" />
            </div>
        </form>
    </div>
</div>

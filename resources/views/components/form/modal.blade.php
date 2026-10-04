<!-- @props(['title', 'modal', 'formId' => null, 'textoGuardar' => null, 'spanGuardar' => null, 'subtitle' => 'Diligencie los datos requeridos', 'btnCancelar' => 'btn-cancelar'])

<div
    x-data="{
        open: false,
        loading: false,

        cerrar() {
            this.open = false;
            this.loading = false;
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
    }"
>
<x-modal :name="$modal">

    <form id="{{ $formId }}" autocomplete="off" class="pt-4 p-6 pb-3">

        <div class="flex items-center gap-2 pb-3 mb-4 border-b">

            <div class="p-1 bg-green-100 rounded-lg">
                <x-heroicon-o-user class="w-8 h-8 text-green-600" />
            </div>

            <div>
                <h2 id='tituloModal' class="text-lg font-semibold ">
                    {{ $title }}
                </h2>
                <p id="subtituloModal" class="text-gray-500 text-sm -mt-6">
                    {{ $subtitle }}
                </p>
            </div>

        </div>

        <div class="space-y-4">
            {{ $slot }}
        </div>

        <div class="flex justify-end gap-2 mt-6 border-t">

            <x-form.button-cancel :modal="$modal" :btnCancelar="$btnCancelar"/>

            <x-form.button-save :texto="$textoGuardar" :spanGuardar="$spanGuardar" />

        </div>

    </form>

</x-modal> -->

@props([
    'title',
    'modal',
    'formId' => null,
    'textoGuardar' => null,
    'spanGuardar' => null,
    'subtitle' => 'Diligencie los datos requeridos',
    'btnCancelar' => 'btn-cancelar'
])

<div
    x-data="{
        loading: false,

        init() {

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
    }"
>
    <x-modal :name="$modal">
  <div
            x-show="loading"
            class="absolute inset-0 z-50 flex items-center justify-center bg-white/70"
        >
            <div class="text-center">
                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-green-600 mx-auto"></div>
                <p class="mt-2 text-sm text-gray-600">
                    Cargando...
                </p>
            </div>
        </div>
        
        <form id="{{ $formId }}" autocomplete="off" class="pt-4 p-6 pb-3">

            <div class="flex items-center gap-2 pb-3 mb-4 border-b">

                <div class="p-1 bg-green-100 rounded-lg">
                    <x-heroicon-o-user class="w-8 h-8 text-green-600" />
                </div>

                <div>
                    <h2 id="tituloModal" class="text-lg font-semibold">
                        {{ $title }}
                    </h2>

                    <p id="subtituloModal" class="text-gray-500 text-sm -mt-6">
                        {{ $subtitle }}
                    </p>
                </div>

            </div>

            <div class="space-y-4">
                {{ $slot }}
            </div>

            <div class="flex justify-end gap-2 mt-6 border-t">

                <x-form.button-cancel
                    :modal="$modal"
                    :btnCancelar="$btnCancelar"
                />

                <x-form.button-save
                    :texto="$textoGuardar"
                    :spanGuardar="$spanGuardar"
                />

            </div>

        </form>

    </x-modal>
</div>
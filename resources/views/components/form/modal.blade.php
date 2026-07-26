@props(['title', 'modal', 'formId' => null, 'textoGuardar' => null])

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
                    Diligencie los datos requeridos
                </p>
            </div>

        </div>

        <div class="space-y-4">
            {{ $slot }}
        </div>

        <div class="flex justify-end gap-2 mt-6 border-t">

            <x-form.button-cancel :modal="$modal" />

            <x-form.button-save :texto="$textoGuardar" />

        </div>

    </form>

</x-modal>

@props(['texto'])

<button id="btn-guardar" type="submit" 
    class="px-4 py-2 inline-flex items-center gap-2 rounded-md text-sm mt-3 hover:bg-green-700 bg-green-600 text-white">
    <i id="icono-guardar" data-lucide="save-check"></i>
    <span id="span-guardar">
        Guardar {{ $texto }}
    </span>
</button>

@props(['modal'])

<button type="button"  id="btn-cancelar" @click="$dispatch('drawer-close', { id: '{{ $modal }}' })"
    class="px-4 py-2 border inline-flex items-center gap-2 rounded-md text-sm mt-3">
    <i id="icono-cancelar" data-lucide="x"></i>
    Cancelar
</button>

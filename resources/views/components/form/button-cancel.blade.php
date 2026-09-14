@props(['modal'])

<button id="btn-cancelar" {{ $attributes->merge([
    'type' => 'button',
    'class' => '
        group
        relative
        overflow-hidden
        rounded-md
        border
        border-gray-200
        bg-white
        h-10 mt-3
        px-5
        text-sm
        text-gray-700
        shadow-sm
        transition-all
        duration-300
        hover:-translate-y-0.5
        hover:bg-gray-50
        hover:shadow-2xl
        active:translate-y-0
    '
]) }}
>

    <div class="relative z-10 flex items-center justify-center gap-2">
        <i id="icono-cancelar" data-lucide="x" class="w-4 h-4"></i>

        <span id="span-cancelar">
            Cancelar
        </span>
    </div>

    {{-- Animación gris --}}
    <span class="absolute inset-y-0 left-0 w-1/3
        bg-gray-200/40
        -skew-x-12
        -translate-x-[200%]
        group-hover:translate-x-[400%]
        transition-transform
        duration-700">
    </span>

</button>


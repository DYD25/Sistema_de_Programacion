@props(['texto'])

<button {{ $attributes->merge([
        'type' => 'submit',
        'class' => '
            group
            relative
            overflow-hidden
            rounded-md
            bg-gradient-to-r
            from-[#21783E]
            via-[#1F9A72]
            to-[#1FA6A6]
            h-10 mt-3
            px-5
            text-white
            shadow-sm
            transition-all
            duration-300
            hover:-translate-y-0.5
            hover:shadow-2xl
            active:translate-y-0
            active:scale-[0.98]
        '
    ]) }}>

    <div class="relative z-10 flex items-center justify-center gap-2">
        <i id="icono-guardar" data-lucide="save-check" class="w-2 h-2"></i>
        <span id="span-guardar" class="text-sm">
            Guardar {{ $texto }}
        </span>

    </div>

    <span class="absolute inset-y-0 left-0 w-1/3
        bg-white/10
        -skew-x-12
        -translate-x-[200%]
        group-hover:translate-x-[400%]
        transition-transform
        duration-700">
    </span>
</button>
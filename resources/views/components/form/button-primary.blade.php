<button
    {{ $attributes->merge([
        'type' => 'submit',
        'class' => '
            group
            relative
            w-full
            overflow-hidden
            rounded-2xl
            bg-gradient-to-r
            from-[#21783E]
            via-[#1F9A72]
            to-[#1FA6A6]
            py-2.5
            px-6
            font-semibold
            text-white
            shadow-lg
            transition-all
            duration-300
            hover:-translate-y-0.5
            hover:shadow-2xl
            active:translate-y-0
            active:scale-[0.98]
            focus:outline-none
            focus:ring-4
            focus:ring-[#1FA6A6]/30
        '
    ]) }}
>

    <span
        class="absolute inset-0
        bg-white/10
        translate-x-[-120%]
        group-hover:translate-x-[120%]
        transition-transform
        duration-700
        skew-x-12">
    </span>

    <span class="relative flex items-center justify-center gap-2">

        {{ $slot }}

        <x-heroicon-o-arrow-right
            class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1"/>

    </span>

</button>
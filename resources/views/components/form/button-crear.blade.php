@props([
    'id',
    'title' => 'Crear',
])

<button id="{{ $id }}"data-tooltip="{{ $title }}" data-position="left"
    {{ $attributes->merge([
        'class' => 'relative inline-flex items-center justify-center
                    w-10 h-10
                    bg-green-600 hover:bg-green-700
                    text-white rounded-full
                    bg-gradient-to-r from-[#21783E] via-[#1F9A72] to-[#1FA6A6]
                    transition
                    shadow-md
                    group'
    ]) }}>
    <span class="absolute inset-0 rounded-full bg-green-500 animate-ping opacity-40"></span>
    <x-heroicon-o-plus class="relative w-5 h-5" />
</button>
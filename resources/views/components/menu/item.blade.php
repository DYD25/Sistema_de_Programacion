@props(['href', 'active' => false])


<a href="{{ $href }}"
    class="menu-item flex items-center gap-3 px-4 py-2 rounded-md transition-all duration-200
    {{ $active ? 'bg-gradient-to-r from-[#166534] via-[#1FA6A6] shadow-lg font-semibold scale-[1.003]'
    : ' hover:bg-gradient-to-r hover:from-[#166534] via-[#1FA6A6]  hover:shadow-md hover:scale-[1.003]'}}">

    <span class="flex-shrink-0">
        {{ $icon }}
    </span>

    <span class="menu-text whitespace-nowrap">
        {{ $slot }}
    </span>

</a>

@props(['href', 'active' => false])

<a href="{{ $href }}"
    class="menu-item flex items-center gap-3 px-4 py-3 rounded-md transition-all duration-200
    {{ $active ? 'bg-[#21783E] text-white shadow font-medium' : 'text-green-100 hover:bg-green-600' }}">

    <span class="flex-shrink-0">
        {{ $icon }}
    </span>

    <span class="menu-text whitespace-nowrap">
        {{ $slot }}
    </span>

</a>

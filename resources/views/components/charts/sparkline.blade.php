@props([
    'color' => '#21783E'
])

<svg
    viewBox="0 0 100 30"
    class="w-full h-full"
    fill="none"
    xmlns="http://www.w3.org/2000/svg">

    <defs>

        <linearGradient id="gradient-{{ md5($color) }}" x1="0" y1="0" x2="0" y2="1">

            <stop offset="0%" stop-color="{{ $color }}" stop-opacity=".35"/>

            <stop offset="100%" stop-color="{{ $color }}" stop-opacity="0"/>

        </linearGradient>

    </defs>

    <path
        d="M2 24
           C12 20,18 10,28 14
           S45 26,56 18
           S70 6,82 12
           S92 20,98 8"
        stroke="{{ $color }}"
        stroke-width="2.5"
        stroke-linecap="round"
        stroke-linejoin="round"/>

    <path
        d="M2 24
           C12 20,18 10,28 14
           S45 26,56 18
           S70 6,82 12
           S92 20,98 8
           L98 30
           L2 30 Z"
        fill="url(#gradient-{{ md5($color) }})"/>

</svg>
@props([
    'value' => 0,
    'color' => 'green',
    'height' => 'h-2',
])

@php

$colors = [

    'green' => 'from-[#21783E] to-[#1FA6A6]',

    'yellow' => 'from-yellow-400 to-amber-500',

    'red' => 'from-red-400 to-red-600',

    'blue' => 'from-sky-400 to-sky-600',

];

@endphp

<div class="w-full {{ $height }} bg-slate-200 rounded-full overflow-hidden">

    <div
        class="h-full rounded-full bg-gradient-to-r {{ $colors[$color] ?? $colors['green'] }}"
        style="width: {{ $value }}%">
    </div>

</div>

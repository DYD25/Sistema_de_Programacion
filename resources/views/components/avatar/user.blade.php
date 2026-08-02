@props([
    'name',
    'size' => 'md',
])

@php

$sizes = [

    'sm' => 'w-8 h-8 text-xs',

    'md' => 'w-10 h-10 text-sm',

    'lg' => 'w-12 h-12 text-lg',

    'xl' => 'w-14 h-14 text-xl',

];

@endphp

<div
    class="{{ $sizes[$size] ?? $sizes['md'] }}
           rounded-full
           bg-gradient-to-br
           from-[#21783E]
           to-[#1FA6A6]
           flex
           items-center
           justify-center
           font-bold
           text-white
           shadow-sm">

    {{ strtoupper(substr($name,0,1)) }}

</div>
@props([
    'type' => 'success',
])

@php

    $styles = [
        'green' => 'bg-green-100 text-green-700',

        'yellow' => 'bg-yellow-100 text-yellow-700',

        'red' => 'bg-red-100 text-red-700',

        'blue' => 'bg-sky-100 text-sky-700',

        'gray' => 'bg-slate-100 text-slate-600',
    ];

@endphp

<span
    {{ $attributes->merge([
        'class' => 'inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold '.($styles[$type] ?? $styles['gray'])
    ]) }}>

    {{ $slot }}

</span>

@props(['day', 'date', 'title', 'time', 'status', 'color' => 'green', 'last' => false])

@php

    $colors = [
        'green' => [
            'bg' => 'bg-green-50',
            'text' => 'text-green-600',
            'dot' => 'bg-green-600',
            'badge' => 'bg-green-100 text-green-700',
        ],

        'yellow' => [
            'bg' => 'bg-yellow-50',
            'text' => 'text-yellow-600',
            'dot' => 'bg-yellow-500',
            'badge' => 'bg-yellow-100 text-yellow-700',
        ],

        'blue' => [
            'bg' => 'bg-blue-50',
            'text' => 'text-blue-600',
            'dot' => 'bg-sky-500',
            'badge' => 'bg-blue-100 text-blue-700',
        ],

        'purple' => [
            'bg' => 'bg-purple-50',
            'text' => 'text-purple-600',
            'dot' => 'bg-purple-500',
            'badge' => 'bg-slate-100 text-slate-600',
        ],
    ];

    $style = $colors[$color];

@endphp


<div class="grid grid-cols-[70px_30px_1fr_auto] gap-4 px-6 py-1 items-center">

    {{-- Fecha --}}
    <div class="{{ $style['bg'] }} rounded-xl py-1 text-center  ">

        <p class="text-xs font-bold {{ $style['text'] }}">
            {{ strtoupper($day) }}
        </p>

        <p class="text-2xl font-bold text-slate-800">
            {{ $date }}
        </p>

    </div>


    {{-- Línea --}}
    <div class="relative flex items-center justify-center self-stretch">

        <span class="absolute top-1/2 left-1/2 h-full w-0.5 -translate-x-1/2 -translate-y-1/2 bg-slate-200"></span>

        <span class="relative z-10 h-3 w-3 rounded-full {{ $style['dot'] }}"></span>

    </div>


    {{-- Información --}}
    <div>

        <h4 class="font-semibold text-slate-800">
            {{ $title }}
        </h4>

        <p class="text-sm text-slate-500">
            {{ $time }}
        </p>

    </div>


    {{-- Estado --}}
    <span class="rounded-md px-4 py-1 text-sm font-medium {{ $style['badge'] }}">

        {{ $status }}

    </span>

</div>

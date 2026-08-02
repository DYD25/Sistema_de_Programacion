@props([
    'percentage' => 67,
    'color' => '#21783E',
])

@php

$circumference = 2 * pi() * 48;
$offset = $circumference - ($percentage / 100) * $circumference;

@endphp

<div class="flex flex-col items-center">

    <svg
        class="w-44 h-44 -rotate-90"
        viewBox="0 0 120 120">

        {{-- Fondo --}}
        <circle
            cx="60"
            cy="60"
            r="48"
            fill="none"
            stroke="#E5E7EB"
            stroke-width="10"/>

        {{-- Progreso --}}
        <circle
            cx="60"
            cy="60"
            r="48"
            fill="none"
            stroke="{{ $color }}"
            stroke-width="10"
            stroke-linecap="round"
            stroke-dasharray="{{ $circumference }}"
            stroke-dashoffset="{{ $offset }}"/>

    </svg>

    <div class="-mt-28 text-center">

        <p class="text-4xl font-bold text-slate-800">

            {{ $percentage }}%

        </p>

        <p class="mt-1 text-sm text-slate-500">

            Avance

        </p>

    </div>

</div>
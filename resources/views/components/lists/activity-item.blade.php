@props([
    'title',
    'description',
    'time',
    'color' => 'green'
])

@php

    $styles = [

        'green' => [
            'bg' => 'bg-green-100',
            'text' => 'text-green-600',
            'icon' => 'check-circle',
        ],

        'yellow' => [
            'bg' => 'bg-yellow-100',
            'text' => 'text-yellow-600',
            'icon' => 'pencil-square',
        ],

        'blue' => [
            'bg' => 'bg-sky-100',
            'text' => 'text-sky-600',
            'icon' => 'calendar-days',
        ],

        'red' => [
            'bg' => 'bg-red-100',
            'text' => 'text-red-600',
            'icon' => 'exclamation-circle',
        ],

    ];

    $style = $styles[$color];

@endphp

<div class="flex items-start gap-4 py-4">

    <div class="flex h-10 w-10 items-center justify-center rounded-xl {{ $style['bg'] }}">

        @switch($style['icon'])

            @case('check-circle')
                {{-- <x-heroicon-o-check-circle class="w-5 h-5 {{ $style['text'] }}" /> --}}
                <x-heroicon-o-users class="w-5 h-5 {{ $style['text'] }}" />
                @break

            @case('pencil-square')
                {{-- <x-heroicon-o-pencil-square class="w-5 h-5 {{ $style['text'] }}" /> --}}
                <x-heroicon-o-users class="w-5 h-5 {{ $style['text'] }}" />
                @break

            @case('calendar-days')
                <x-heroicon-o-calendar-days class="w-5 h-5 {{ $style['text'] }}" />
                @break

            @case('exclamation-circle')
                <x-heroicon-o-exclamation-circle class="w-5 h-5 {{ $style['text'] }}" />
                @break

        @endswitch

    </div>

    <div class="flex-1">

        <div class="flex items-center justify-between">

            <h4 class="font-semibold text-slate-800">

                {{ $title }}

            </h4>

            <span class="text-xs text-slate-400">

                {{ $time }}

            </span>

        </div>

        <p class="mt-1 text-sm text-slate-500">

            {{ $description }}

        </p>

    </div>

</div>

<div class="border-b border-slate-100 last:hidden"></div>
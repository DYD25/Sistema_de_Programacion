@props(['day', 'title', 'hour', 'status', 'color' => 'green'])

@php

    $colors = [
        'green' => [
            'dot' => 'bg-green-500',
            'badge' => 'bg-green-100 text-green-700',
        ],
        'yellow' => [
            'dot' => 'bg-yellow-400',
            'badge' => 'bg-yellow-100 text-yellow-700',
        ],
        'blue' => [
            'dot' => 'bg-sky-500',
            'badge' => 'bg-sky-100 text-sky-700',
        ],
        'red' => [
            'dot' => 'bg-red-500',
            'badge' => 'bg-red-100 text-red-700',
        ],
    ];

@endphp

<div class="flex items-center justify-between py-5 border-b border-slate-100 last:border-0">

    <div class="flex items-start gap-4">

        <span class="mt-2 w-3 h-3 rounded-full {{ $colors[$color]['dot'] }}"></span>

        <div>

            <p class="text-[11px] uppercase tracking-widest text-slate-400 font-semibold">

                {{ $day }}

            </p>

            <h4 class="mt-1 text-lg font-semibold text-slate-800">

                {{ $title }}

            </h4>

            <p class="mt-1 text-sm text-slate-500">

                {{ $hour }}

            </p>

            <x-badges.status class="mt-3" :type="$color">

                {{ $status }}

            </x-badges.status>

        </div>

    </div>

</div>

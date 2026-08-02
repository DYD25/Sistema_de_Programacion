@props([
    'title' => null,
    'padding' => 'p-0',
    
])

<div class="bg-white rounded-xl shadow-sm {{ $padding }}">

    @if (isset($header))

        <div class="border-b px-4 py-3">

            {{ $header }}

        </div>
    @elseif($title || isset($icon))

        <div class="border-b px-4 py-3 flex items-center gap-2">

            @isset($icon)
                {{ $icon }}
            @endisset

            @if ($title)
                <h3 class="font-semibold text-slate-800">

                    {{ $title }}

                </h3>
            @endif

        </div>

    @endif

    <div class="px-1 py-0">

        {{ $slot }}

    </div>

    @isset($footer)
        <div class="border-t px-4 py-3">

            {{ $footer }}

        </div>
    @endisset

</div>

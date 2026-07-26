@props([
    'title' => null,
    'padding' => 'p-0'
])

<div class="bg-white rounded-xl shadow-sm {{$padding}}">

    @if($title || isset($icon))
        <div class="border-b px-4 py-2 flex items-center gap-2">

            @isset($icon)
                {{ $icon }}
            @endisset

            @if($title)
                <h3 class="font-semibold">
                    {{ $title }}
                </h3>
            @endif

        </div>
    @endif

    <div class="px-1 py-0">
        {{ $slot }}
    </div>

</div>
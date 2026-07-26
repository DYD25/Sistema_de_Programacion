@props(['title', 'subtitle' => ''])

<div class="flex flex-col gap-4 mb-3 md:flex-row md:items-center md:justify-between ">

    <div class="flex items-start gap-3">

        <div class="flex items-center justify-center w-12 h-12 rounded-lg bg-green-100">
            {{ $icon }}
        </div>

        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                {{ $title }}
            </h1>

            @if ($subtitle)
                <p class="-mt-6 text-1xl text-gray-500">
                    {{ $subtitle }}
                </p>
            @endif
        </div>
    </div>

    @isset($actions)
        <div class="flex items-center">
            {{ $actions }}
        </div>
    @endisset

</div>

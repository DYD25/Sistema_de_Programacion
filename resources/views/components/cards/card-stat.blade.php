@props([
    'title',
    'texto',
    'value',
    'valueId' => null,
    'titleId' => null,
    'subtitleId' => null,
    'textoSuperior' => null,
])

<div class="bg-white rounded-xl shadow-sm p-4 h-full">

    <div class="flex flex-col h-full">

        {{-- Texto superior --}}
        <p class="text-[11px] text-gray-400">
            {{ $textoSuperior }}
        </p>

        {{-- Título --}}
        <h3 id="{{ $titleId }}" class="text-sm font-semibold mt-0">
            {{ $title }}
        </h3>


        <div class="flex items-center justify-between mt-1 ">

            {{-- Valor --}}
            <p id="{{ $valueId }}" class="text-3xl font-bold ">
                {{ $value }}
            </p>

            {{-- Mini gráfica --}}
            <div class="!w-24 h-10 flex items-center justify-end">
                {{ $slot }}
            </div>
        </div>

        {{-- Pie --}}
        <div class="flex items-center justify-between mt-3">

            <span id="{{ $subtitleId }}" class="text-xs text-gray-500">
                {{ $texto }}
            </span>

            @isset($footer)
                {{ $footer }}
            @endisset
        </div>

    </div>

</div>

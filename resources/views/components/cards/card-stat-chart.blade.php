@props([
'title',
'subtitle' => null,
'value' => '0',
'valueId' => null,
'subtitleId' => null,
'textoSuperior' => null,
'topText' => null,
])

<div
    class="group bg-white rounded-2xl border border-slate-200 p-5 shadow-sm hover:shadow-lg transition-all duration-300">

    <div class="grid grid-cols-1 md:grid-cols-[40%_60%]">

        {{-- ========================================= --}}
        {{-- INFORMACIÓN --}}
        {{-- ========================================= --}}
        <div class="flex min-w-0 items-center pr-5">

            {{-- Información --}}
            <div class="flex min-h-20 flex-col justify-between">

                <div>

                    @if ($textoSuperior)

                    <p class="text-xs font-medium text-slate-400">
                        {{ $textoSuperior }}
                    </p>

                    @endif


                    <h4 class="text-sm font-semibold text-slate-800">
                        {{ $title }}
                    </h4>


                    @if ($subtitleId)

                    <p
                        id="{{ $subtitleId }}"
                        class="text-xs text-slate-500">

                        {{ $subtitle }}

                    </p>

                    @elseif ($subtitle)

                    <p class="text-xs text-slate-500">
                        {{ $subtitle }}
                    </p>

                    @endif

                </div>


                {{-- Valor --}}
                <p
                    @if ($valueId) id="{{ $valueId }}" @endif
                    class="mt-2 text-4xl font-bold tracking-tight text-slate-900">

                    {{ $value }}

                </p>

            </div>

        </div>


        {{-- ========================================= --}}
        {{-- GRÁFICA + FOOTER --}}
        {{-- ========================================= --}}
        <div class="min-w-0 border-l border-slate-200 pl-5">

            {{-- Gráfica --}}
            <div class="flex min-h-20 min-w-0 items-center justify-center overflow-hidden">

                <div class="w-full max-w-full min-w-0">
                    {{ $slot }}
                </div>

        </div>


        {{-- Footer --}}
        @isset($footer)

        <div class="mt-2 flex justify-end">

            {{ $footer }}

        </div>

        @endisset

    </div>

</div>

</div>
@props([
    'title' => null,
    'subtitle' => null,
    'footer' => null,
])

<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

    {{-- Encabezado --}}
    @if($title || $subtitle)

        <div class="px-6 py-5 border-b border-slate-100">

            @if($title)
                <h3 class="text-lg font-semibold text-slate-800">
                    {{ $title }}
                </h3>
            @endif

            @if($subtitle)
                <p class="mt-1 text-sm text-slate-500">
                    {{ $subtitle }}
                </p>
            @endif

        </div>

    @endif


    {{-- Contenido --}}
    <div class="p-6">

        {{ $slot }}

    </div>


    {{-- Footer --}}
    @if($footer)

        <div class="px-6 py-4 border-t border-slate-100">

            {{ $footer }}

        </div>

    @endif

</div>
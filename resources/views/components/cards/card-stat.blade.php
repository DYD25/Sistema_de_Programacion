@props(['title', 'subtitle', 'value', 'trend' => null, 'icon' => null])

<div
    class="group bg-white rounded-2xl border border-slate-200 p-5 shadow-sm hover:shadow-lg transition-all duration-300">

    <div class="flex items-center justify-between">

        <div class="flex items-center gap-4">

            {{-- Icono --}}
            <div
                class="flex h-20 w-20 items-center justify-center rounded-2xl bg-gradient-to-br from-[#21783E] to-[#1FA6A6] shadow-md">

                @if ($icon)
                    {{ $icon }}
                @else
                    <x-heroicon-o-chart-bar class="w-10 h-10 text-white" />
                @endif

            </div>

            <div class="flex h-20 flex-col justify-between">

                <div>
                    <h4 class="text-sm font-semibold text-slate-800">
                        {{ $title }}
                    </h4>

                    <p class="text-xs text-slate-500">
                        {{ $subtitle }}
                    </p>
                </div>

                <p class="text-4xl font-bold tracking-tight text-slate-900">
                    {{ $value }}
                </p>

            </div>

        </div>

        <div class="flex flex-col items-end justify-between h-20">

            <div class="opacity-80">
                {{ $chart ?? '' }}
            </div>

            @if ($trend)
                <span
                    class="inline-flex items-center rounded-full bg-green-50 px-2 py-1 text-xs font-semibold text-green-700">
                    ↑ {{ $trend }}
                </span>
            @endif

        </div>

    </div>

</div>

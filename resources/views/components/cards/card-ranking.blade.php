@props(['name', 'area', 'percentage', 'position' => null])

<div class="flex items-center gap-4 py-4 border-b border-slate-100 last:border-0">

    {{-- Avatar --}}
    <x-avatar.user :name="$name" size="lg" />

    {{-- Información --}}
    <div class="flex-1">

        <div class="flex items-center justify-between">

            <div>

                <h4 class="font-semibold text-slate-800">

                    {{ $name }}

                </h4>

                <p class="text-sm text-slate-500">

                    {{ $area }}

                </p>

            </div>

            <span class="text-sm font-bold text-[#21783E]">

                {{ $percentage }}%

            </span>

        </div>

        <div class="mt-3">

            <x-progress.bar :value="$percentage" color="green" />

        </div>

    </div>

</div>

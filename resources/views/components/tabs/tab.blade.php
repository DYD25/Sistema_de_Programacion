@props([
'id',
'tabs' => [],
'activo' => null,
])

@php
$tabActivo = $activo ?? ($tabs[0]['id'] ?? null);
@endphp

<div id="{{ $id }}" data-tabs data-tab-activo="{{ $tabActivo }}">
    <div class="mb-6 mt-6 border-b border-slate-200" role="tablist">

        <nav class="flex gap-6">
            @foreach ($tabs as $tab)
            <button type="button" role="tab" data-tab="{{ $tab['id'] }}" data-ruta="{{ $tab['ruta'] ?? '' }}"
                class="tab-button inline-flex items-center gap-2 px-2 pb-3 text-md font-semibold border-b-2 transition-all duration-200
                            {{ $tabActivo === $tab['id']  ? 'border-green-600 text-green-600' : 'border-transparent text-slate-500 hover:text-slate-700' }}">
                <x-dynamic-component :component="$tab['icon']" class="w-5 h-5" />
                {{ $tab['texto'] }}
            </button>
            @endforeach
        </nav>
    </div>

    <div id="{{ $id }}-content" class="tab-content">
        {{ $slot }}
    </div>

</div>
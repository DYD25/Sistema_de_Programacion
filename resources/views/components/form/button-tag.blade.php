@props([
    'tab',
    'texto',
    'activo' => false,
])

<button
    type="button"
    {{ $attributes->merge([
        'class' => 'tab-administracion px-1 pb-3 text-md font-semibold border-b-2 ' .
            ($activo ? 'border-green-600 text-green-600' : 'border-transparent text-slate-500 hover:text-slate-700')
    ]) }}
    data-tab="{{ $tab }}">
    <span class="flex items-center gap-2">
        {{ $slot }}
        {{ $texto }}
    </span>
</button>

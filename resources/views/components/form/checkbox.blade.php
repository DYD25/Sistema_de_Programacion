@props([
    'name',
    'label',
])

<label class="flex items-center gap-3 cursor-pointer">

    <input
        type="checkbox"
        name="{{ $name }}"
        id="{{ $name }}"
        {{ $attributes }}
      class="estilos-checkbox">


    <span class="text-sm text-slate-600">
        {{ $label }}
    </span>

</label>
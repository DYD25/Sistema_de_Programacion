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
      class="w-5 h-5 rounded-md border-slate-300 text-[#1FA6A6] shadow-sm transition focus:ring-0 focus:outline-none focus:border-[#1FA6A6]">

    <span class="text-sm text-slate-600">
        {{ $label }}
    </span>

</label>
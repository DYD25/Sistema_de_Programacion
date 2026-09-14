@props(['value', 'obligatorio' => false])

<label {{ $attributes->merge(['class' => 'block  mb-2 text-sm font-semibold text-slate-700']) }}>
    {{ $value ?? $slot }}
    @if ($obligatorio)
        <span class="text-red-500">*</span>
    @endif
</label>

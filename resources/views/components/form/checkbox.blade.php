@props([
    'label',
    'name',
    'checked' => false
])

<label class="flex items-center gap-2">
    <input
        type="checkbox"
        name="{{ $name }}"
        value="1"
        @checked($checked)
    >

    <span>{{ $label }}</span>
</label>
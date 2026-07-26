@props([
    'label',
    'name',
    'options' => []
])

<div>
    <x-input-label :for="$name" :value="$label" />

    <select
        id="{{ $name }}"
        name="{{ $name }}"
        class="mt-1 block w-full border-gray-300 rounded-md"
    >
        @foreach($options as $value => $text)
            <option value="{{ $value }}">
                {{ $text }}
            </option>
        @endforeach
    </select>

    <x-input-error :messages="$errors->get($name)" />
</div>
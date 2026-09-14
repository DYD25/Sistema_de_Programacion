@props([
    'label',
    'name',
    'options' => [],
    'obligatorio' => false,
     'icon' => null
])

<div class="select-general">
    <x-input-label :for="$name" :value="$label" :obligatorio="$obligatorio" />


        <select id="{{ $name }}"  name="{{ $name }}" class="mt-1 block w-full" @if($icon) data-icon="{{ $icon }}" @endif >
            @foreach($options as $value => $text)
                <option value="{{ $value }}">
                    {{ $text }}
                </option>
            @endforeach
        </select>


    <x-input-error :messages="$errors->get($name)" />
</div>
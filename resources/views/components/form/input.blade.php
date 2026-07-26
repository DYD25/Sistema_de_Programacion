@props([
    'label' => '',
    'name',
    'type' => 'text',
    'value' => '',
    'placeholder' => '',
    'obligatorio' => false,
])

<div>
    <x-input-label :for="$name" :value="$label"  :obligatorio="$obligatorio"/>
    <div class="relative mt-1">
        @isset($icon)
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                {{ $icon }}
            </div>
        @endisset
        <x-text-input :id="$name" :name="$name" :type="$type" :value="$value" :placeholder="$placeholder"
            class="block mt-1 w-full  {{ isset($icon) ? 'pl-10' : '' }} " />
    </div>
    <p id="error-{{ $name }}" class="text-red-500 text-sm mt-1"></p>

    {{-- <x-input-error :messages="$errors->get($name)" class="mt-2" /> --}}
</div>

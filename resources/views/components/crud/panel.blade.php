@props([
    'title' => null,
    'modal' => null,
])

<div x-data>
    <div class="w-full bg-white rounded-lg shadow-sm">
        <div class="p-4">
            {{ $slot }}
        </div>

    </div>
</div>

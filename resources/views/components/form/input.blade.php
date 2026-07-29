@props(['label', 'name', 'type' => 'text', 'placeholder' => ''])

<div>

    @if ($label)
        <label for="{{ $name }}" class="block mb-2 text-sm font-semibold text-slate-700">
            {{ $label }}
        </label>
    @endif

    <div class="group relative" data-password-toggle>

        @isset($icon)
            <div
                class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 transition-colors duration-300 group-focus-within:text-[#1FA6A6]">
                {{ $icon }}
            </div>
        @endisset

        <input id="{{ $name }}" name="{{ $name }}" type="{{ $type }}"
            placeholder="{{ $placeholder }}" {{ $attributes }}
            class="peer w-full rounded-2xl border border-slate-200 bg-white py-2.5 pl-11 {{ $type === 'password' ? 'pr-14' : 'pr-5' }} text-slate-700 placeholder:text-slate-400 shadow-sm transition-all duration-300 hover:border-slate-300 outline-none focus:outline-none focus:border-[#1FA6A6] focus:ring-4 focus:ring-[#1FA6A6]/20">

        @if ($type === 'password')
            <button type="button" data-toggle
                class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 transition-colors duration-300 hover:text-[#1FA6A6]">

                <x-heroicon-o-eye data-eye class="w-5 h-5" />
                <x-heroicon-o-eye-slash data-eye-slash class="hidden w-5 h-5" />

            </button>
        @endif

    </div>

    @error($name)
        <p class="mt-2 text-sm text-red-500">
            {{ $message }}
        </p>
    @enderror

</div>

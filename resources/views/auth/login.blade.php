<x-guest-layout>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">

        @csrf

        {{-- Correo --}}
        {{-- <div>

            <x-input-label for="email" value="Correo electrónico" class="mb-2 font-semibold" />

            <div class="relative">

                <div class="absolute inset-y-0 left-0 flex items-center pl-4">
                    <x-heroicon-o-envelope class="w-5 h-5 text-gray-400" />
                </div>

                <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                    autocomplete="username" placeholder="correo@ejemplo.com"
                    class=" w-full    rounded-xl   border-gray-300    pl-12   pr-4   py-3      shadow-sm    focus:border-[#21783E]     focus:ring-[#21783E]  ">

            </div>

            <x-input-error :messages="$errors->get('email')" class="mt-2" />

        </div> --}}

        <x-ui.input label="Correo electrónico" name="email" type="email" placeholder="ejemplo@correo.com"
            :value="old('email')" required autofocus autocomplete="username">

            <x-slot:icon>

                <x-heroicon-o-envelope class="w-5 h-5" />

            </x-slot:icon>

        </x-ui.input>
{{-- Contraseña --}}
        <x-ui.input label="Contraseña" name="password" type="password" placeholder="••••••••" required
            autocomplete="current-password">

            <x-slot:icon>
                <x-heroicon-o-lock-closed class="w-5 h-5" />
            </x-slot:icon>

        </x-ui.input>
        

        {{-- Recordarme --}}
        <div class="flex items-center justify-between">

            <label class="flex items-center gap-2">

                <input type="checkbox" name="remember"
                    class="rounded border-gray-300 text-[#21783E] focus:ring-[#21783E]">

                <span class="text-sm text-gray-600">
                    Recordarme
                </span>

            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm text-[#21783E] hover:underline">
                    ¿Olvidaste tu contraseña?
                </a>
            @endif

        </div>

        {{-- Botón --}}
        <x-ui.button-primary>
            Entrar al sistema
        </x-ui.button-primary>

    </form>

</x-guest-layout>

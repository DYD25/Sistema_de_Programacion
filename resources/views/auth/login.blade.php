<x-guest-layout>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="text-center mb-10">

        <div
            class="mx-auto w-14 h-14 rounded-2xl bg-gradient-to-br from-[#21783E] to-[#1FA6A6] flex items-center justify-center shadow-lg">

            <x-heroicon-o-building-library class="w-7 h-7 text-white" />

        </div>

        <h1 class="mt-6 text-2xl font-bold text-slate-800">
            Sistema de Programación
        </h1>

        <p class="mt-2 text-slate-500">
            Bienvenido nuevamente
        </p>

        <p class="mt-1 text-sm text-slate-400">
            Accede con tu cuenta para continuar.
        </p>

    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-6">

        @csrf

        {{-- Correo --}}

        <x-form.input label="Correo electrónico" name="email" type="email" placeholder="ejemplo@correo.com"
            :value="old('email')" required autofocus autocomplete="username">

            <x-slot:icon>

                <x-heroicon-o-envelope class="w-5 h-5" />

            </x-slot:icon>

        </x-form.input>
        {{-- Contraseña --}}
        <x-form.input label="Contraseña" name="password" type="password" placeholder="••••••••" required
            autocomplete="current-password">

            <x-slot:icon>
                <x-heroicon-o-lock-closed class="w-5 h-5" />
            </x-slot:icon>

        </x-form.input>


        {{-- Recordarme --}}

        <div class="flex items-center justify-between mt-6">

            <x-form.checkbox name="remember" label="Recordarme" :checked="old('remember')" />
            
            {{-- @if (Route::has('password.request')) --}}
            
            <a href="#"
            class="text-sm font-medium text-[#1FA6A6] hover:text-[#21783E] transition-colors">
            
            ¿Olvidaste tu contraseña?

                </a>
            {{-- @endif --}}

        </div>

        {{-- Botón --}}
        <x-form.button-primary>
            Entrar al sistema
        </x-form.button-primary>

    </form>

</x-guest-layout>

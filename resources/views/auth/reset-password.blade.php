<x-guest-layout>

    <div class="text-center mb-10">

        <div class="mx-auto w-14 h-14 rounded-2xl bg-gradient-to-br from-[#21783E] to-[#1FA6A6] flex items-center justify-center shadow-lg">

            <x-heroicon-o-lock-closed class="w-7 h-7 text-white"/>

        </div>

        <h1 class="mt-6 text-2xl font-bold text-slate-800">
            Restablecer contraseña
        </h1>

        <p class="mt-2 text-slate-500">
            Crea una nueva contraseña para acceder nuevamente al sistema.
        </p>

    </div>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-6">

        @csrf

        <input type="hidden" name="token" value="{{ request()->route('token') }}">

        <x-ui.input
            label="Correo electrónico"
            name="email"
            type="email"
            :value="old('email', request('email'))"
            required
            autocomplete="username">

            <x-slot:icon>
                <x-heroicon-o-envelope class="w-5 h-5"/>
            </x-slot:icon>

        </x-ui.input>

        <x-ui.input
            label="Nueva contraseña"
            name="password"
            type="password"
            placeholder="••••••••"
            required
            autocomplete="new-password">

            <x-slot:icon>
                <x-heroicon-o-lock-closed class="w-5 h-5"/>
            </x-slot:icon>

        </x-ui.input>

        <x-ui.input
            label="Confirmar contraseña"
            name="password_confirmation"
            type="password"
            placeholder="••••••••"
            required
            autocomplete="new-password">

            <x-slot:icon>
                <x-heroicon-o-lock-closed class="w-5 h-5"/>
            </x-slot:icon>

        </x-ui.input>

        <x-ui.button-primary
            type="submit"
            class="w-full">

            Restablecer contraseña

        </x-ui.button-primary>

    </form>

</x-guest-layout>
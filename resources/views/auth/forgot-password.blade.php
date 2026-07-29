<x-guest-layout>

    <div class="text-center mb-8">

        <div
            class="mx-auto w-14 h-14 rounded-2xl bg-gradient-to-br from-[#21783E] to-[#1FA6A6] flex items-center justify-center shadow-lg">
            <x-heroicon-o-key class="w-7 h-7 text-white" />
        </div>
        <h1 class="mt-6 text-2xl font-bold text-slate-800">
            Recuperar contraseña
        </h1>

        <p class="mt-3 text-sm leading-6 text-slate-500">
            Ingresa tu correo electrónico y te enviaremos un enlace para restablecer tu contraseña.
        </p>
    </div>

    <x-auth-session-status class="mb-5" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">

        @csrf

        <x-form.input label="Correo electrónico" name="email" type="email" placeholder="ejemplo@correo.com"
            :value="old('email')" required autofocus autocomplete="username">
            <x-slot:icon>
                <x-heroicon-o-envelope class="w-5 h-5" />
            </x-slot:icon>
        </x-form.input>


        <x-form.button-primary>
            Enviar enlace
        </x-form.button-primary>    

    </form>

    <div class="mt-8 text-center">
        <a href="{{ route('login') }}" class="text-sm font-medium text-[#1FA6A6] hover:text-[#21783E] transition">
            ← Volver al inicio de sesión
        </a>
    </div>

</x-guest-layout>

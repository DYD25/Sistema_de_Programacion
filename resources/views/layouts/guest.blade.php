<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/auth/auth.js'])
</head>

<body class="font-sans antialiased bg-gray-100">

    <div class="min-h-screen grid lg:grid-cols-5">


        {{-- Panel izquierdo --}}
        <div class="hidden lg:flex lg:col-span-3 relative overflow-hidden items-center justify-center">

            {{-- Fondo --}}
            <div
                class="absolute inset-0
        bg-gradient-to-br
        from-[#143A63]
        via-[#1C6E8C]
        to-[#55C595]">
            </div>
            {{-- Cuadrícula --}}
            <div class="absolute inset-0 opacity-[0.05]"
                style="
        background-image:
        linear-gradient(white 1px, transparent 1px),
        linear-gradient(90deg, white 1px, transparent 1px);
        background-size:40px 40px;
    ">
            </div>

            {{-- Círculo grande --}}
            <div class="absolute -top-48 -left-48 w-[650px] h-[650px]
        rounded-full bg-white/5 blur-3xl">
            </div>

            {{-- Círculo pequeño --}}
            <div class="absolute bottom-0 right-0 w-[350px] h-[350px]
        rounded-full bg-cyan-300/10 blur-3xl">
            </div>

            {{-- Contenido --}}
            <div class="relative z-10 max-w-xl px-16">

                <h1 class="text-5xl font-bold leading-tight text-white">

                    Sistema de
                    <br>
                    Programación

                </h1>

                <p class="mt-8 text-xl text-cyan-50 leading-9">

                    Gestiona miembros, ministerios y toda la programación
                    de tu iglesia desde una plataforma moderna, organizada
                    y fácil de usar.

                </p>

                <div class="mt-14 space-y-5">

                    <div class="flex items-center gap-3">

                        <div
                            class="w-11 h-11 rounded-full bg-white/10 backdrop-blur-sm
                    flex items-center justify-center">

                            <x-heroicon-o-user-group class="w-5 h-5 text-white" />

                        </div>

                        <span class="text-lg text-white">

                            Gestión de miembros

                        </span>

                    </div>

                    <div class="flex items-center gap-3">

                        <div
                            class="w-11 h-11 rounded-full bg-white/10 backdrop-blur-sm
                    flex items-center justify-center">

                            <x-heroicon-o-calendar-days class="w-5 h-5 text-white" />

                        </div>

                        <span class="text-lg text-white">

                            Programación semanal

                        </span>

                    </div>

                    <div class="flex items-center gap-3">

                        <div
                            class="w-11 h-11 rounded-full bg-white/10 backdrop-blur-sm
                    flex items-center justify-center">

                            <x-heroicon-o-building-library class="w-5 h-5 text-white" />

                        </div>

                        <span class="text-lg text-white">

                            Administración de ministerios

                        </span>

                    </div>

                </div>

                <div class="mt-14">

                    <p class="text-cyan-100 italic leading-8 text-lg">
                        "Sirviendo con excelencia,
                        organizando con propósito."
                    </p>

                </div>

            </div>

        </div>

        {{-- Panel derecho --}}
        <div
            class="lg:col-span-2 relative overflow-hidden flex items-center justify-center bg-gradient-to-br from-white via-slate-50 to-[#EAF7F4]">

            <div class="absolute -top-40 -right-40 w-[500px] h-[500px] rounded-full bg-[#1FA6A6]/10 blur-3xl"></div>

            <div class="absolute -bottom-32 -left-20 w-[350px] h-[350px] rounded-full bg-[#21783E]/10 blur-3xl"></div>

            {{-- Tarjeta Login --}}
            <div
                class="relative z-10 w-full max-w-md mx-8 rounded-3xl bg-white/85 backdrop-blur-xl border border-white/60 shadow-[0_30px_70px_rgba(15,23,42,.12)] p-10 animate-fade-up">
             
                {{ $slot }}
                
                <div class="mt-10 border-t border-slate-200 pt-5 text-center">

                    <p class="text-xs text-slate-400">

                        Versión 1.0 · © {{ date('Y') }}

                    </p>

                </div>

            </div>

        </div>

    </div>

</body>

</html>

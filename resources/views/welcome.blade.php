<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="icon" href="/favicon.ico">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="relative min-h-screen overflow-x-hidden">

    {{-- Background --}}
    <div class="fixed inset-0 -z-10">
        <img
            src="{{ asset('images/gb2.jpg') }}"
            alt="Background"
            class="w-full h-full object-cover"
        >

        {{-- Overlay --}}
        <div class="absolute inset-0 bg-black/60"></div>
    </div>

    {{-- Navbar --}}
    <header class="absolute top-0 left-0 right-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-5">
            <div class="flex items-center justify-between">

                <a href="/" class="text-2xl font-bold text-white uppercase">
                    {{ config('app.name') }}
                </a>

                @if (Route::has('login'))
                    <nav class="flex items-center gap-4">
                        @auth
                            <a
                                href="{{ route('dashboard') }}"
                                class="bg-transparent hover:bg-blue-700 text-white px-5 py-2 rounded-lg transition"
                            >
                                Dashboard
                            </a>
                        @else
                            <a
                                href="{{ route('login') }}"
                                class="bg-transparent hover:bg-blue-700 text-white px-5 py-2 rounded-lg transition"
                            >
                                Login
                            </a>

                            @if (Route::has('register'))
                                <a
                                    href="{{ route('register') }}"
                                    class="bg-transparent hover:bg-blue-700 text-white px-5 py-2 rounded-lg transition"
                                >
                                    Register
                                </a>
                            @endif
                        @endauth
                    </nav>
                @endif

            </div>
        </div>
    </header>

    {{-- Hero Section --}}
    <main class="relative z-10 min-h-screen flex items-center justify-center">

        <div class="text-center px-6 max-w-4xl">

            <h1 class="text-5xl md:text-7xl font-bold text-white mb-6">
                Halo, Saya Sutiyoso
            </h1>

            <p class="text-lg md:text-xl text-gray-200 mb-8">
                Freelancer yang bergerak di bidang
                <span class="font-semibold">Web Development</span>,
                <span class="font-semibold">Laravel</span>,

                <span class="font-semibold">dan Desain Grafis</span>.
            </p>



        </div>

    </main>

</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://cdn.tailwindcss.com"></script>
        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
        <style>
            body {
                font-family: 'Poppins';font-size: 22px;
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-[#F5EFEB] text-black/50">
        <div class="text-black/50 bg-[#F5EFEB]">

            <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
                <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                    <header class="w-full py-5 bg-[#C8D9E6] shadow-lg rounded-lg">
                        <nav class="flex items-center justify-between w-full px-6">
                            <!-- Left side (Logo or Title) -->
                            <div class="text-xl font-semibold text-black">
                                RateView
                            </div>

                            <!-- Right side (Links) -->
                            <div class="space-x-4">
                                @if (Route::has('login'))
                                    @auth
                                        <a href="{{ url('/dashboard') }}" class="px-3 py-2 text-black hover:text-black/70">
                                            Dashboard
                                        </a>
                                    @else
                                        <a href="{{ route('login') }}" class="px-3 py-2 text-black hover:text-black/70">
                                            Log in
                                        </a>

                                        @if (Route::has('register'))
                                            <a href="{{ route('register') }}" class="px-3 py-2 text-black hover:text-black/70">
                                                Register
                                            </a>
                                        @endif
                                    @endauth
                                @endif
                            </div>
                        </nav>
                    </header>

                    <main class="mt-6">
                        <!-- Main content here -->
                        <section class="relative bg-cover bg-center h-[60vh] text-white" style="background-image: url('{{ asset('images/thing.gif') }}');">
                        <div class="absolute inset-0 bg-black opacity-50"></div> <!-- Overlay for better text visibility -->
                            <div class="relative flex items-center justify-center h-full">
                                <div class="text-center p-6">
                                    <h1 class="text-4xl md:text-6xl font-bold mb-4">Rate-View</h1>
                                    <p class="text-lg md:text-xl mb-6">Rate Shows That You Have Viewed</p>
                                    <a href="{{ route('register') }}" class="bg-[#2F4156] hover:bg-[#567C8D] text-white font-semibold py-3 px-6 rounded transition">
                                        Get Started
                                    </a>
                                </div>
                            </div>
                        </section>


                    </main>

                    <footer class="py-16 text-center text-sm text-black">
                        Webpro IUP 2024
                    </footer>
                </div>
            </div>
        </div>
    </body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">

            <x-header></x-header>

            <main>
                {{ $slot }}
            </main>
        </div>
        <section class="bg-teal-600 py-6 text-white">
            <div class="container max-w-screen-xl mx-auto px-4">
                <div class="lg:flex justify-between">
                    <div class="mb-3">
                        <img src="{{asset('img/payments.png')}}" height="24" class="h-6" alt="Payment methods">
                    </div>
                    <div class="space-x-6">
                        <nav class="text-sm space-x-4">
                            <a href="#" class="opacity-70 hover:opacity-100">
                                © All rights reserved 2022
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>

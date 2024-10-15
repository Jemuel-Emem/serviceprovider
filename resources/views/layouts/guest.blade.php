<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>LHSP</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Additional Styling -->
    <style>
        /* Keyframe animation to smoothly transition between blue shades */
        @keyframes blueLightingEffect {
            0% {
                background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            }
            25% {
                background: linear-gradient(135deg, #2962ff 0%, #2e86c1 100%);
            }
            50% {
                background: linear-gradient(135deg, #3498db 0%, #5dade2 100%);
            }
            75% {
                background: linear-gradient(135deg, #2a5298 0%, #2962ff 100%);
            }
            100% {
                background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            }
        }

        body {
            background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
            animation: blueLightingEffect 10s infinite alternate; /* Smooth color transitions every 10 seconds */
            transition: background 0.3s ease;
        }

        .logo-container img {
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .logo-container img:hover {
            transform: scale(1.05);
        }

        .card {
            background: #fff;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease-in-out;
        }

        .card:hover {
            box-shadow: 0 6px 30px rgba(0, 0, 0, 0.15);
        }

        .primary-button {
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }

        .primary-button:hover {
            background-color: #2980b9;
        }

        .primary-button:focus {
            outline: 3px solid rgba(52, 152, 219, 0.5);
        }

        .text-gray-500 {
            color: #7f8c8d;
        }

        .custom-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #2c3e50;
        }

        /* Responsive adjustments */
        @media (min-width: 640px) {
            .card {
                padding: 2.5rem;
            }
        }
    </style>
</head>
<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <!-- Logo Section -->
        <div class="logo-container">
            <a href="/" wire:navigate>
                <img src="{{ asset('images/serviceprovider.jpg') }}" alt="Service Provider" class="w-24 h-24 rounded-full">
            </a>
        </div>

        <!-- Card Section -->
        <div class="w-full sm:max-w-md mt-8 px-6 py-8 card">
            <h2 class="custom-title text-center mb-6">{{ __('Welcome Back!') }}</h2>


            {{ $slot }}

            <!-- Optional Primary Button Example -->
            {{-- <div class="mt-6 text-center">
                <a href="/" class="primary-button">
                    {{ __('Go to Dashboard') }}
                </a>
            </div> --}}
        </div>
    </div>
</body>
</html>

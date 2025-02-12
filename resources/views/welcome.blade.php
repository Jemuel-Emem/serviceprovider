<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>LHSP</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased relative bg-gray-100 dark:bg-gray-900 selection:bg-red-500 selection:text-white">

        <!-- Background Image -->
        <div class="absolute inset-0 bg-cover bg-center opacity-30" style="background-image: url('{{ asset('images/bgser.png') }}');"></div>

        <!-- Main Content -->
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen flex-col">
            @if (Route::has('login'))
                <livewire:welcome.navigation />
            @endif

            <div class="flex flex-col items-center justify-center mt-60">
                <label for="service-search" class="mb-4 text-3xl font-bold text-primary">
                    Find Service You Want
                </label>

                <div class="flex space-x-4">
                    <input
                        id="service-search"
                        type="text"
                        placeholder="Search for services..."
                        class="p-4 w-96 text-xl border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                        wire:model="search"
                    />

                    <a href="{{ route('login') }}">
                        <button class="px-6 py-4 bg-orange-500 text-white text-xl font-bold rounded-lg hover:bg-orange-600 focus:ring-2 focus:ring-orange-400 focus:outline-none">
                            Find Services
                        </button>
                    </a>
                </div>

                @if(!empty($search))
                    <div class="w-full">
                        @if($services->isEmpty())
                            <p class="text-xl text-gray-500">No services found.</p>
                        @else
                            <ul class="space-y-2">
                                @foreach($services as $service)
                                    <li class="flex items-center p-4 border border-gray-300 rounded-lg">
                                        <img src="{{ asset('storage/' . $service->photo_path) }}" alt="{{ $service->service_name }}" class="w-24 h-24 object-cover rounded-md mr-4">
                                        <div>
                                            <h3 class="text-lg font-bold">{{ $service->service_name }}</h3>
                                            <p class="text-gray-700">{{ $service->address }}</p>
                                            <p class="text-xl font-semibold text-green-600">{{ number_format($service->price, 2) }} PHP</p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Service Provider System Description -->
            <div class="mt-12 px-8 text-center max-w-3xl">
                <h2 class="text-2xl font-bold text-indigo-700">About Our Service Provider System</h2>
                <p class="mt-4 text-gray-700 text-lg">
                    Our platform connects customers with professional service providers for various needs, ensuring
                    quality and convenience. Browse, book, and rate services with ease. Whether you need home repairs,
                    beauty treatments, or professional consulting, we’ve got you covered.
                </p>
            </div>
        </div>
    </body>
</html>

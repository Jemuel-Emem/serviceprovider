<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ServiceProvider</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet" />

    <style>
        [x-cloak] {
            display: none;
        }

        .background-farm {
            background-image: url('{{ asset('images/farm.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            width: 100%;
            filter: brightness(0.7);
        }

        .bg-primary {
            background-color: #1E3A8A;
        }

        .bg-secondary {
            background-color: #3B82F6;
        }

        .text-primary {
            color: #1E3A8A;
        }

        .text-secondary {
            color: #3B82F6;
        }

        .nav-link {
            color: #93C5FD;
        }

        .nav-link:hover {
            color: #1E3A8A;
        }

        .nav-logo {
            color: #3B82F6;
        }

        .disabled-link {
            pointer-events: none;
            opacity: 0.6;
            cursor: not-allowed;
        }
    </style>
@wireUiScripts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased h-full bg-no-repeat bg-cover ">

    <x-notifications position="top-left" />
    <nav class="bg-primary border-gray-200">
        <div class="flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="{{ asset('images/serviceprovider.jpg') }}" alt="Service Provider" class="w-16 h-16 border-2 rounded-full">
                <label for="" class="font-black text-white text-2xl nav-logo">LHSP</label>
            </a>
            <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-200 rounded-lg md:hidden hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="navbar-default" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                </svg>
            </button>
            <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0">
                    <li>
                        <a href="{{ route('client-dashboard') }}" class="block py-2 px-3 text-white uppercase font-bold nav-link">Home</a>
                    </li>
                    <li>
                        <a href="{{ route('service-off') }}" class="{{ (!Auth::user()->gcashnumber || !Auth::user()->gcashname || !Auth::user()->id_photo) ? 'disabled-link' : 'nav-link' }} block py-2 px-3 text-white uppercase font-bold nav-link">Services Offer</a>
                    </li>
                    <li>
                        @php
                            $appointmentCount = \App\Models\Appointment::where('serviceprovider_id', Auth::id())
                                ->where('status', 'on-process')
                                ->count();
                        @endphp

                        <a href="{{ route('app') }}" class="{{ (!Auth::user()->gcashnumber || !Auth::user()->gcashname || !Auth::user()->id_photo) ? 'disabled-link' : 'nav-link' }} block py-2 px-3 text-white uppercase font-bold nav-link relative">
                            Appointments
                            @if($appointmentCount > 0)
                                <span class="bg-red-600 text-white text-xs font-bold rounded-full px-2 py-1 absolute top-0 right-0 transform translate-x-2 -translate-y-2">
                                    {{ $appointmentCount }}
                                </span>
                            @endif
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('message') }}" class=" {{ (!Auth::user()->gcashnumber || !Auth::user()->gcashname || !Auth::user()->id_photo) ? 'disabled-link' : 'nav-link' }} block py-2 px-3 text-white uppercase font-bold nav-link">Message</a>
                    </li>

                    <li>
                        <a href="{{ route('prof') }}" class=" block py-2 px-3 text-white uppercase font-bold">Profile</a>
                    </li>

                    <li>
                        <a href="{{ route('log') }}" class="block py-2 px-3 text-white uppercase font-bold bg-red-500 rounded">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="border-gray-200 rounded-lg dark:border-gray-700  flex items-center justify-center">
        <main>
            @if(Auth::check() && Auth::user()->role == 2)
            @if(Auth::user()->serviceproviderstatus === 'approving')
                <div class="text-center">
                    <div class="bg-white">
                        <h1 class="text-4xl font-bold text-indigo-600 mb-4">WAIT FOR APPROVAL</h1>
                        <p class="text-lg text-gray-700">
                            Your account is currently being reviewed by our administrators. We will notify you once the approval process is complete.
                        </p>
                        <p class="mt-4 text-sm text-gray-500">
                            Thank you for your patience and for choosing to provide services on our platform.
                        </p>
                    </div>
                </div>
            @elseif(Auth::user()->serviceproviderstatus === 'declined')
                <div class="text-center">
                    <div class="bg-white">
                        <h1 class="text-4xl font-bold text-red-600 mb-4">APPLICATION DECLINED</h1>
                        <p class="text-lg text-gray-700">
                            Unfortunately, your application has been declined. You may review the requirements and reapply if applicable.
                        </p>
                    </div>
                </div>
            @else
                {{ $slot }}
            @endif
        @endif
        </main>
    </div>

    @livewireScripts
</body>

</html>

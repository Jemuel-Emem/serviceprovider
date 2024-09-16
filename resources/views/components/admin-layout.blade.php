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
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet"/>

    <style>
        [x-cloak] {
            display: none;
        }

        .background-section {
            background-image: url('{{ asset('images/farm.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            padding: 20px;
            border-radius: 10px;
            height: 750px;
        }

        .bg-opacity-75 {
            background-color: rgba(255, 255, 255, 0.75);
        }

        .sidebar-footer {
            position: absolute;
            bottom: 0;
            width: 90%;
            padding: 10px 0;
            text-align: center;
            background-color: #4CAF50; /* Green shade for footer */
        }

        /* Customizing sidebar */
        .sidebar {
            background-color: #2C3E50; /* Dark blue-gray */
        }

        .sidebar a {
            color: white;
            padding: 10px;
            display: flex;
            align-items: center;
            text-decoration: none;
        }



        /* Responsive print styles */
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @wireUiScripts
    @livewireStyles
</head>

<body class="font-sans antialiased relative bg-gray-100">

    <button data-drawer-target="sidebar-multi-level-sidebar" data-drawer-toggle="sidebar-multi-level-sidebar"
        aria-controls="sidebar-multi-level-sidebar" type="button"
        class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden focus:outline-none focus:ring-2 focus:ring-gray-200">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd"
                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
            </path>
        </svg>
    </button>

    <aside id="sidebar-multi-level-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0 sidebar"
        aria-label="Sidebar">
        <div class="h-full px-3 py-4 overflow-y-auto">
            <ul class="space-y-2 font-medium">
                <a href="#">
                    <div class="flex flex-col items-center h-full px-3 overflow-y-auto">
                        <div>
                            <img src="{{ asset('images/serviceprovider.jpg') }}" alt="Profile Photo" class="w-16 h-16 border-2 rounded-full">
                        </div>
                        <div class="text-center mt-2">
                            <label for="" class="font-black text-white text-xl">SERVICE PROVIDER</label>
                        </div>
                    </div>
                </a>
                <li>
                    <a href="{{ route('admin-dashboard') }}" class="flex items-center p-2 rounded-lg">
                        <i class="ri-dashboard-fill"></i>
                        <span class="ms-3">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('serv')  }}" class="flex items-center p-2 rounded-lg">
                        <i class="ri-user-2-fill"></i>
                        <span class="ms-3">Service Provider</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('appointment-list')  }}" class="flex items-center p-2 rounded-lg">
                        <i class="ri-user-2-fill"></i>
                        <span class="ms-3">Appointment</span>
                    </a>
                </li>
            </ul>

            <div class="sidebar-footer bg-indigo-600  flex justify-center">
                <a href="{{ route('log') }}" class="text-white text-lg font-semibold rounded-md px-4 py-2 inline-block hover:text-red-500 transition duration-300 ease-in-out">
                    Logout
                </a>
            </div>

        </div>
    </aside>

    <div class="p-4 sm:ml-64 background-section">
        <div class="p-6 bg-opacity-75 border-gray-200 rounded-lg">
            <main>
                {{ $slot }}
            </main>
        </div>
    </div>

    @livewireScripts
</body>

</html>

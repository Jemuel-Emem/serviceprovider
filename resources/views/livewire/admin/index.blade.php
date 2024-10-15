<div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Approved Service Providers Card -->
        <div class="bg-white rounded-lg shadow-lg p-6 flex items-center">
            <div class="w-16 h-16 bg-blue-600 text-white flex items-center justify-center rounded-full">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <div class="ml-4">
                <h2 class="text-3xl font-semibold text-gray-700">{{ $approvedProviders }}</h2>
                <p class="text-gray-500">Approved Service Providers</p>
            </div>
        </div>

        <!-- Total Services Card -->
        <div class="bg-white rounded-lg shadow-lg p-6 flex items-center">
            <div class="w-16 h-16 bg-green-600 text-white flex items-center justify-center rounded-full">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h18M3 9h18M9 21h6"></path>
                </svg>
            </div>
            <div class="ml-4">
                <h2 class="text-3xl font-semibold text-gray-700">{{ $totalServices }}</h2>
                <p class="text-gray-500">Total Services</p>
            </div>
        </div>

        <!-- Appointments Card -->
        <div class="bg-white rounded-lg shadow-lg p-6 flex items-center">
            <div class="w-16 h-16 bg-red-600 text-white flex items-center justify-center rounded-full">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3M3 8h18M21 8a2 2 0 01-2 2H5a2 2 0 01-2-2m0 0V6a2 2 0 012-2h14a2 2 0 012 2v2m0 10h-.01M16 19h-4M8 19H6m2-4h10m0 4h-2"></path>
                </svg>
            </div>
            <div class="ml-4">
                <h2 class="text-3xl font-semibold text-gray-700">{{ $totalAppointments }}</h2>
                <p class="text-gray-500">Appointments</p>
            </div>
        </div>
    </div>
</div>

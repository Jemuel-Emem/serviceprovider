<div class="p-6 bg-white shadow-md rounded-lg max-w-8xl mx-auto">
    <h2 class="text-2xl font-bold mb-6 text-center">Search Services</h2>

    <!-- Search Input and Button -->
    <div class="mb-6">
        <input type="text" wire:model="search" placeholder="Search services..." class="border border-gray-300 rounded-md p-2 w-full" />
        <button wire:click="searchh" class="mt-2 bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Search</button>
    </div>

    <!-- Display Services in Card Layout -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @if($services->isEmpty())
            <p class="text-gray-500">No services found.</p>
        @else
            @foreach($services as $service)
                <div class="bg-white shadow-lg rounded-lg p-4">
                    <!-- Service Photo -->
                    <img src="{{ asset('storage/' . $service->photo_path) }}" alt="Service Photo" class="h-32 w-full object-cover rounded-t-lg mb-4">

                    <!-- Service Info -->
                    <div class="text-lg font-semibold">{{ $service->service_name }}</div>
                    <p class="text-gray-600">{{ $service->description }}</p>
                    <p class="text-gray-600">Address: {{ $service->address }}</p>
                    <div class="mt-2 text-indigo-600 font-bold">${{ number_format($service->price, 2) }}</div>

                    <!-- Appoint Button -->
                    <button wire:click="viewService({{ $service->id }})" class="mt-4 bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 w-full">Book Now</button>
                </div>
            @endforeach
        @endif
    </div>

    <!-- Pagination Links -->
    <div class="mt-6">
        {{ $services->links() }}
    </div>

    @if($showModal)
    <div class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-3xl p-6">
            <h3 class="text-xl font-semibold mb-4">{{ $selectedService->service_name }}</h3>
            <img src="{{ asset('storage/' . $selectedService->photo_path) }}" alt="Service Photo" class="h-32 w-full object-cover rounded-lg mb-4">
            <p class="text-gray-600 mb-2">{{ $selectedService->description }}</p>
            <p class="text-gray-600 mb-2">Address: {{ $selectedService->address }}</p>
            <p class="text-indigo-600 font-bold text-lg mb-4">${{ number_format($selectedService->price, 2) }}</p>

            <!-- Date of Appointment -->
            <div class="mb-4">
                <label for="appointment_date" class="block text-sm font-medium text-gray-700">Date of Appointment</label>
                <input type="date" id="appointment_date" wire:model="appointment_date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" />
                @error('appointment_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Method of Payment (MOP) -->
            <div class="mb-4">
                <label for="payment_method" class="block text-sm font-medium text-gray-700">Method of Payment</label>
                <select id="payment_method" wire:model="payment_method" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" onchange="toggleGcashInfo()">
                    <option value="">Select Payment Method</option>
                    <option value="walk_in">Walk In</option>
                    <option value="gcash">Gcash</option>
                </select>
                @error('payment_method') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div id="gcash-info" class="mb-4 hidden">
                <h4 class="text-lg font-semibold">Gcash Payment Information</h4>
                <p>Account Name: Your Gcash Account Name</p>
                <p>Account Number: Your Gcash Account Number</p>
              
                <!-- File Upload for Receipt -->
                <div class="mt-4">
                    <label for="receipt" class="block text-sm font-medium text-gray-700">Upload Gcash Receipt</label>
                    <input type="file" id="receipt" wire:model="receipt" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                    @error('receipt') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Appoint Now Button -->
            <div class="flex justify-between">
                <button wire:click="appointNow" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Appoint Now</button>
                <button wire:click="closeModal" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700">Close</button>
            </div>
        </div>
    </div>
@endif



<!-- Flash Message -->
@if(session()->has('message'))
    <div class="fixed bottom-0 right-0 p-4">
        <div class="bg-green-500 text-white p-4 rounded-md shadow-md">
            {{ session('message') }}
        </div>
    </div>
@endif

<script>
    function toggleGcashInfo() {
        var paymentMethod = document.getElementById('payment_method').value;
        var gcashInfo = document.getElementById('gcash-info');

        if (paymentMethod === 'gcash') {
            gcashInfo.classList.remove('hidden');
        } else {
            gcashInfo.classList.add('hidden');
        }
    }
</script>

</div>

<div class="p-6 bg-white shadow-md rounded-lg mx-auto w-12/12">
    <h2 class="text-3xl font-bold mb-6 text-center text-indigo-700">My Appointments</h2>

    <!-- Appointments Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow-lg rounded-lg overflow-hidden border">
            <thead class="bg-indigo-600 text-white">
                <tr>
                    <th class="py-3 px-4 text-left font-semibold">Service Name</th>
                    <th class="py-3 px-4 text-left font-semibold">Price</th>
                    <th class="py-3 px-4 text-left font-semibold">Date of Appointment</th>
                    <th class="py-3 px-4 text-left font-semibold">Status</th>
                    <th class="py-3 px-4 text-left font-semibold">Rate</th>
                </tr>
            </thead>
            <tbody class="bg-gray-100">
                @forelse($appointments as $appointment)
                    <tr class="hover:bg-gray-200 transition duration-300">
                        <td class="py-4 px-4 border-b border-gray-200">{{ $appointment->servicename }}</td>
                        <td class="py-4 px-4 border-b border-gray-200">${{ number_format($appointment->price, 2) }}</td>
                        <td class="py-4 px-4 border-b border-gray-200">{{ \Carbon\Carbon::parse($appointment->dateofappointment)->format('F j, Y') }}</td>
                        <td class="py-4 px-4 border-b border-gray-200">
                            <span class="px-3 py-1 rounded-full text-sm font-semibold
                                @if($appointment->status === 'on-process') bg-yellow-200 text-yellow-700
                                @elseif($appointment->status === 'completed') bg-green-200 text-green-700
                                @elseif($appointment->status === 'canceled') bg-red-200 text-red-700
                                @endif">
                                {{ ucfirst($appointment->status) }}
                            </span>
                        </td>
                        <!-- Rate Button -->
                        <td class="py-4 px-4 border-b border-gray-200">
                            @if($appointment->status === 'completed')
                                <button wire:click="openRateModal({{ $appointment->id }})" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Rate</button>
                            @else
                                <span class="text-gray-500">Not Available</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-6 text-center text-gray-500">No appointments found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $appointments->links() }}
    </div>

    <!-- Rate Modal -->
    @if($showRateModal)
    <div class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6">
            <h3 class="text-xl font-semibold mb-4">Rate {{ $selectedAppointment->servicename }}</h3>

            <!-- Rating Input -->
            <div class="mb-4">
                <label for="rating" class="block text-sm font-medium text-gray-700">Rating</label>
                <input type="number" id="rating" wire:model="rating" min="1" max="5" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" placeholder="Rate from 1 to 5">
                @error('rating') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Comment Input -->
            <div class="mb-4">
                <label for="comment" class="block text-sm font-medium text-gray-700">Comment</label>
                <textarea id="comment" wire:model="comment" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" placeholder="Write your comment here..."></textarea>
                @error('comment') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Rate Now Button -->
            <div class="flex justify-between">
                <button wire:click="rateAppointment" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Rate Now</button>
                <button wire:click="closeRateModal" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700">Close</button>
            </div>
        </div>
    </div>
    @endif

    @if(session()->has('message'))
    <div class="fixed bottom-0 right-0 p-4">
        <div class="bg-green-500 text-white p-4 rounded-md shadow-md">
            {{ session('message') }}
        </div>
    </div>
    @endif
</div>

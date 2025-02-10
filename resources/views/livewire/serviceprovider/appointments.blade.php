<div class="p-6 bg-white shadow-md rounded-lg mx-auto w-12/12 ">
    <h2 class="text-3xl font-bold mb-6 text-center text-indigo-700">My Appointments</h2>

    <!-- Search Input -->
    <div class="mb-6 flex justify-center">
        <input type="text" wire:model="search" placeholder="Search appointments..." class="border border-gray-300 rounded-l-md p-2 w-full max-w-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
        <button class="bg-indigo-600 text-white px-4 py-2 rounded-r-md hover:bg-indigo-700 transition duration-300">Search</button>
    </div>

    <!-- Appointments Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow-lg rounded-lg overflow-hidden border">
            <thead class="bg-indigo-600 text-white">
                <tr>
                    <th class="py-3 px-4 text-left font-semibold">Client Name</th>
                    <th class="py-3 px-4 text-left font-semibold">Address</th>
                    <th class="py-3 px-4 text-left font-semibold">Phone Number</th>
                    <th class="py-3 px-4 text-left font-semibold">Service Name</th>
                    <th class="py-3 px-4 text-left font-semibold">Price</th>
                    <th class="py-3 px-4 text-left font-semibold">Date of Appointment</th>
                    <th class="py-3 px-4 text-left font-semibold">Method of Payment</th>
                    <th class="py-3 px-4 text-left font-semibold">GCash Receipt</th>
                    <th class="py-3 px-4 text-left font-semibold">Status</th>
                    <th class="py-3 px-4 text-center font-semibold">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-gray-100">
                @forelse($appointments as $appointment)
                    <tr class="hover:bg-gray-200 transition duration-300">
                        <td class="py-4 px-4 border-b border-gray-200">{{ $appointment->clientname }}</td>
                        <td class="py-4 px-4 border-b border-gray-200">{{ $appointment->address }}</td>
                        <td class="py-4 px-4 border-b border-gray-200">{{ $appointment->phonenumber }}</td>
                        <td class="py-4 px-4 border-b border-gray-200">{{ $appointment->servicename }}</td>
                        <td class="py-4 px-4 border-b border-gray-200">${{ number_format($appointment->price, 2) }}</td>
                        <td class="py-4 px-4 border-b border-gray-200">{{ \Carbon\Carbon::parse($appointment->dateofappointment)->format('F j, Y') }}</td>
                        <td class="py-4 px-4 border-b border-gray-200">{{ ucfirst($appointment->mop) }}</td>
                        <td class="py-4 px-4 border-b border-gray-200">
                            @if($appointment->gcashreceipt)
                                <a href="{{ asset('storage/' . $appointment->gcashreceipt) }}" target="_blank" class="text-indigo-600 hover:underline">View Receipt</a>
                            @else
                                <span class="text-gray-500">No receipt</span>
                            @endif
                        </td>
                        <td class="py-4 px-4 border-b border-gray-200">
                            <span class="px-3 py-1 rounded-full text-sm font-semibold
                                @if($appointment->status === 'on-process') bg-yellow-200 text-yellow-700
                                @elseif($appointment->status === 'completed') bg-green-200 text-green-700
                                @elseif($appointment->status === 'canceled') bg-red-200 text-red-700
                                @endif">
                                {{ ucfirst($appointment->status) }}
                            </span>
                        </td>
                        <td class="py-4 px-4 border-b border-gray-200">
                            @if($appointment->status === 'on-process')
                                <button wire:click="approveAppointment({{ $appointment->id }})" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">Approve</button>
                                <button wire:click="declineAppointment({{ $appointment->id }})" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700">Decline</button>
                            @else
                                <span class="text-gray-500">Action taken</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="py-6 text-center text-gray-500">No appointments found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $appointments->links('pagination::tailwind') }}
    </div>
</div>

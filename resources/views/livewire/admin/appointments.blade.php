<div class="p-6 bg-white shadow-md rounded-lg w-11/12 mx-auto ">
    <h2 class="text-2xl font-bold mb-6 text-center">Appointments</h2>


    <div class="mb-4">
        <input type="text" wire:model="search" placeholder="Search appointments..." class="border border-gray-300 rounded-md p-2 w-full" />
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="w-1/4 py-2">Client Name</th>
                    <th class="w-1/4 py-2">Address</th>
                    <th class="w-1/4 py-2">Service Name</th>
                    {{-- <th class="w-1/4 py-2">Client</th> --}}
                    <th class="w-1/4 py-2">Date of Appointment</th>
                    <th class="w-1/4 py-2">Price</th>
                    <th class="w-1/4 py-2">Method of Payment</th>
                    <th class="w-1/4 py-2">Status</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @forelse($appointments as $appointment)
                    <tr>
                        <td class="py-2 px-4 text-center">{{ $appointment->clientname }}</td>
                        <td class="py-2 px-4 text-center">{{ $appointment->address }}</td>
                        <td class="py-2 px-4 text-center">{{ $appointment->servicename }}</td>
                        {{-- <td class="py-2 px-4 text-center">{{ $appointment->client->name }}</td> --}}
                        <td class="py-2 px-4 text-center">{{ $appointment->dateofappointment }}</td>
                        <td class="py-2 px-4 text-center">{{ number_format($appointment->price, 2) }}</td>
                        <td class="py-2 px-4 text-center">{{ ucfirst($appointment->mop) }}</td>
                        <td class="py-4 px-4 border-b border-gray-200">
                            <span class="px-3 py-1 rounded-full text-sm font-semibold
                                @if($appointment->status === 'on-process') bg-yellow-200 text-yellow-700
                                @elseif($appointment->status === 'completed') bg-green-200 text-green-700
                                @elseif($appointment->status === 'canceled') bg-red-200 text-red-700
                                @endif">
                                {{ ucfirst($appointment->status) }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-4 text-center text-gray-500">No appointments found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination Links -->
    <div class="mt-6">
        {{ $appointments->links() }}
    </div>
</div>

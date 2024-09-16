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
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-6 text-center text-gray-500">No appointments found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $appointments->links() }}
    </div>
</div>

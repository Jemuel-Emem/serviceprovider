<div class="p-6 bg-white shadow-lg rounded-lg">
    <h2 class="text-3xl font-semibold text-gray-500 mb-6">Service Providers</h2>

    <div class="overflow-x-auto">
        <table class="min-w-full table-auto border-collapse">
            <thead class="bg-gray-100 text-gray-600 text-sm uppercase">
                <tr>
                    <th class="py-3 px-6 text-left border-b">Name</th>
                    <th class="py-3 px-6 text-left border-b">Email</th>
                    <th class="py-3 px-6 text-left border-b">Status</th>
                    <th class="py-3 px-6 text-left border-b ">ID</th>
                    <th class="py-3 px-6 text-left border-b">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-700 text-sm">
                @foreach($serviceProviders as $provider)
                <tr class="border-b hover:bg-gray-50 transition duration-150 ease-in-out">
                    <td class="py-3 px-6">{{ $provider->name }}</td>
                    <td class="py-3 px-6">{{ $provider->email }}</td>
                    <td class="py-3 px-6">
                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                            @if($provider->serviceproviderstatus === 'approved') bg-green-100 text-green-800
                            @elseif($provider->serviceproviderstatus === 'declined') bg-red-100 text-red-800
                            @else bg-yellow-100 text-yellow-800
                            @endif">
                            {{ ucfirst($provider->serviceproviderstatus) }}
                        </span>
                    </td>
                    <td class="py-3 px-6">
                        @if($provider->id_photo)
                            <a href="{{ asset('storage/' . $provider->id_photo) }}" target="_blank">
                                <img src="{{ asset('storage/' . $provider->id_photo) }}" alt="ID Photo" class="w-16 h-16 rounded-full">
                            </a>
                        @else
                            <span class="text-gray-500">No ID Photo</span>
                        @endif
                    </td>

                    <td class="py-3 px-6">
                        @if($provider->serviceproviderstatus === 'approving')
                            <button wire:click="approve({{ $provider->id }})" class="bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600">Approve</button>
                            <button wire:click="decline({{ $provider->id }})" class="bg-red-500 text-white px-4 py-2 rounded-lg shadow hover:bg-red-600 ml-2">Decline</button>
                        @else
                            <span class="text-gray-500">{{ ucfirst($provider->serviceproviderstatus) }}</span>
                        @endif
                    </td>


                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

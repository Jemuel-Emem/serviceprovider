<div class="p-6 bg-white shadow-md rounded-lg max-w-8xl mx-auto">
    <h2 class="text-2xl font-bold mb-6 text-center">{{ $serviceId ? 'Edit' : 'Add' }} Service Offer</h2>

    <form wire:submit.prevent="{{ $serviceId ? 'updateService' : 'addService' }}">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Photo Upload -->
            <div class="col-span-1">
                <label for="photo" class="block text-sm font-medium text-gray-700">Service Photo</label>
                <input type="file" id="photo" wire:model="photo" class="mt-1 block w-full text-sm text-gray-500 file:py-2 file:px-4 file:border file:border-gray-300 file:rounded-md file:text-sm file:font-semibold file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100" />
                @error('photo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Service Name -->
            <div class="col-span-1">
                <label for="service_name" class="block text-sm font-medium text-gray-700">Service Name</label>
                <input type="text" id="service_name" wire:model="service_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" />
                @error('service_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Phone Number -->
            <div class="col-span-1">
                <label for="phone_number" class="block text-sm font-medium text-gray-700">Phone Number</label>
                <input type="text" id="phone_number" wire:model="phone_number" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" />
                @error('phone_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Address -->
            <div class="col-span-1">
                <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                <input type="text" id="address" wire:model="address" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" />
                @error('address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Description -->
            <div class="col-span-1 md:col-span-2">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea id="description" wire:model="description" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"></textarea>
                @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Price -->
            <div class="col-span-1">
                <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                <input type="text" id="price" wire:model="price" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" />
                @error('price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="mt-6 flex justify-end">
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">{{ $serviceId ? 'Update' : 'Add' }} Service</button>
        </div>
    </form>

    <!-- Display the services of the authenticated service provider -->
    <div class="mt-8">
        <h3 class="text-xl font-semibold mb-4">Your Services</h3>

        @if($services->isEmpty())
            <p class="text-gray-500">No services added yet.</p>
        @else
            <table class="min-w-full bg-white border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-2 px-4 border-b text-left">Photo</th>
                        <th class="py-2 px-4 border-b text-left">Service Name</th>
                        <th class="py-2 px-4 border-b text-left">Phone Number</th>
                        <th class="py-2 px-4 border-b text-left">Address</th>
                        <th class="py-2 px-4 border-b text-left">Price</th>
                        <th class="py-2 px-4 border-b text-left">Description</th>
                        <th class="py-2 px-4 border-b text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($services as $service)
                        <tr>
                            <td class="py-2 px-4 border-b">
                                <img src="{{ asset('storage/' . $service->photo_path) }}" alt="Service Photo" class="h-16 w-16 object-cover rounded">
                            </td>
                            <td class="py-2 px-4 border-b">{{ $service->service_name }}</td>
                            <td class="py-2 px-4 border-b">{{ $service->phone_number }}</td>
                            <td class="py-2 px-4 border-b">{{ $service->address }}</td>
                            <td class="py-2 px-4 border-b">${{ number_format($service->price, 2) }}</td>
                            <td class="py-2 px-4 border-b">{{ $service->description }}</td>
                            <td class="py-2 px-4 border-b">
                                <button wire:click="editService({{ $service->id }})" class="text-blue-500 hover:text-blue-700">Edit</button>
                                <button wire:click="deleteService({{ $service->id }})" class="text-red-500 hover:text-red-700 ml-2">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>

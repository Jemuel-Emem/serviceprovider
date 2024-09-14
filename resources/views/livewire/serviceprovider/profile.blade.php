<div class="p-6 bg-white shadow-md rounded-lg max-w-4xl mx-auto">
    <!-- Display Profile Information -->
    <h2 class="text-2xl font-bold mb-6 text-center">Profile Information</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" id="name" wire:model="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100" />
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" id="email" wire:model="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100" />
        </div>

        <!-- Gcash Name -->
        <div>
            <label for="gcashname" class="block text-sm font-medium text-gray-700">Gcash Account Name</label>
            <input type="text" id="gcashname" wire:model="gcashname" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100" />
        </div>

        <!-- Gcash Number -->
        <div>
            <label for="gcashnumber" class="block text-sm font-medium text-gray-700">Gcash Account Number</label>
            <input type="text" id="gcashnumber" wire:model="gcashnumber" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100" />
        </div>

        <!-- Profile Photo -->
        <div class="col-span-2">
            <label for="id_photo" class="block text-sm font-medium text-gray-700">Profile Photo</label>
            @if ($existing_id_photo)
                <img src="{{ asset('storage/' . $existing_id_photo) }}" alt="Profile Photo" class="h-32 w-32 object-cover rounded-lg mt-2">
            @else
                <p class="text-gray-500">No profile photo available.</p>
            @endif
        </div>
    </div>

    <!-- File Upload for Profile Photo -->
    <div class="mt-6">
        <label for="id_photo" class="block text-sm font-medium text-gray-700">Upload New Photo</label>
        <input type="file" id="id_photo" wire:model="id_photo" class="mt-1 block w-full text-sm text-gray-500 file:py-2 file:px-4 file:border file:border-gray-300 file:rounded-md file:text-sm file:font-semibold file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100" />
        @error('id_photo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

        @if ($id_photo)
            <div class="mt-2">
                <img src="{{ $id_photo->temporaryUrl() }}" alt="Profile Photo Preview" class="h-32 w-32 object-cover rounded-lg">
            </div>
        @endif
    </div>

    <!-- Update Profile Button -->
    <div class="mt-6">
        <button wire:click="updateProfile" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Update Profile</button>
    </div>
</div>

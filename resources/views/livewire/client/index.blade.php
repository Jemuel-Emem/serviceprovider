<div class="flex flex-col items-center justify-center mt-60">

    <label for="service-search" class="mb-4 text-3xl font-bold text-primary">
        Find Service You Want
    </label>

    <div class="flex space-x-4">
        <input
            id="service-search"
            type="text"
            placeholder="Search for services..."
            class="p-4 w-96 text-xl border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
            wire:model="search"
        />

        <button
            class="px-6 py-4 bg-orange-500 text-white text-xl font-bold rounded-lg hover:bg-orange-600 focus:ring-2 focus:ring-orange-400 focus:outline-none"
            wire:click="searchServices"> <!-- Call searchServices on button click -->
            Find Services
        </button>
    </div>

    <!-- Display the search results only if there is a search term -->
    @if(!empty($search))
        <div class="mt-6 w-full">
            @if($services->isEmpty())
                <p class="text-xl text-gray-500">No services found.</p>
            @else
                <ul class="space-y-2">
                    @foreach($services as $service)
                        <li class="flex items-center p-4 border border-gray-300 rounded-lg">
                            <img src="{{ asset('storage/' . $service->photo_path) }}" alt="{{ $service->service_name }}" class="w-24 h-24 object-cover rounded-md mr-4"> <!-- Service image -->
                            <div>
                                <h3 class="text-lg font-bold">{{ $service->service_name }}</h3>
                                <p class="text-gray-700">{{ $service->address }}</p>
                                <p class="text-xl font-semibold text-green-600">{{ number_format($service->price, 2) }} PHP</p> <!-- Price -->
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    @endif
</div>

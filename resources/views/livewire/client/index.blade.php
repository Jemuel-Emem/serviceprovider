<div class="relative flex flex-col items-center justify-center min-h-screen bg-cover bg-center bg-no-repeat " style="background-image: url('{{ asset('images/bgser.png') }}');">

    <div class="absolute inset-0 bg-gray-500 opacity-70"></div>

    <div class="relative bg-white bg-opacity-100 p-6 rounded-lg shadow-lg w-9/12">
        <label for="service-search" class="mb-4 text-3xl font-bold text-primary">
            Find Service You Want
        </label>

        <div class="flex space-x-4">
            <input
                id="service-search"
                type="text"
                placeholder="Search for services..."
                class="p-4 w-9/12 text-xl border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                wire:model="search"
            />

            <button
                class="px-6 py-4 bg-orange-500 text-white text-xl font-bold rounded-lg hover:bg-orange-600 focus:ring-2 focus:ring-orange-400 focus:outline-none"
                wire:click="searchServices">
                Find Services
            </button>
        </div>

        @if(!empty($search))
            <div class="mt-6 w-full">
                @if($services->isEmpty())
                    <p class="text-xl text-gray-500">No services found.</p>
                @else
                    <ul class="space-y-2">
                        @foreach($services as $service)
                            <li class="flex items-center p-4 border border-gray-300 rounded-lg">
                                <img src="{{ asset('storage/' . $service->photo_path) }}" alt="{{ $service->service_name }}" class="w-24 h-24 object-cover rounded-md mr-4">
                                <div>
                                    <h3 class="text-lg font-bold">{{ $service->service_name }}</h3>
                                    {{-- <p class="text-gray-700">{{ $service->address }}</p> --}}
                                    <p class="text-xl font-semibold text-green-600">{{ number_format($service->price, 2) }} PHP</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        @endif
    </div>
</div>

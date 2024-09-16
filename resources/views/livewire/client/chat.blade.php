<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-lg">
    <!-- Select dropdown to choose service provider -->
    <div class="mb-6">
        <select wire:model="selectedServiceProvider" class="border border-gray-300 rounded-lg p-3 w-full focus:ring focus:ring-indigo-300 focus:border-indigo-500 transition duration-150 ease-in-out">
            <option value="">Select Service Provider</option>
            @foreach($serviceProviders as $provider)
                <option value="{{ $provider->id }}">{{ $provider->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Button to load chat form and messages -->
    <div class="mb-6 text-right">
        <button wire:click="loadMessages" class="bg-indigo-600 text-white px-5 py-3 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring focus:ring-indigo-300 transition duration-150 ease-in-out">
            Load Chat
        </button>
    </div>

    <!-- Chat box -->
    @if($selectedServiceProvider && !empty($messages))
        <div class="border border-gray-300 rounded-lg p-6 mb-6 max-h-96 overflow-y-auto bg-gray-50">
            @foreach($messages as $message)
                <div class="mb-4">
                    <strong class="{{ $message->from_client ? 'text-blue-600' : 'text-green-600' }}">
                        {{ $message->from_client ? 'Client' : 'Service Provider' }}:
                    </strong>
                    <p class="text-gray-800 bg-white p-3 rounded-lg shadow-sm">{{ $message->message }}</p>
                </div>
            @endforeach
        </div>

        <!-- Form to send new message -->
        <form wire:submit.prevent="sendMessage" class="flex items-center space-x-4">
            <input type="text" wire:model="newMessage" placeholder="Type your message..." class="flex-1 border border-gray-300 rounded-lg p-3 focus:ring focus:ring-indigo-300 focus:border-indigo-500 transition duration-150 ease-in-out">
            <button type="submit" class="bg-indigo-600 text-white px-5 py-3 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring focus:ring-indigo-300 transition duration-150 ease-in-out">
                Send
            </button>
        </form>
    @elseif($selectedServiceProvider)
        <p class="mt-6 text-gray-500 text-center">No messages found. Start a conversation by sending a message.</p>
    @else
        <p class="mt-6 text-gray-500 text-center">Select a service provider and click "Load Chat" to start chatting.</p>
    @endif

    <!-- Flash Message -->
    @if(session()->has('message'))
        <div class="fixed bottom-0 right-0 p-4">
            <div class="bg-red-500 text-white p-4 rounded-lg shadow-md">
                {{ session('message') }}
            </div>
        </div>
    @endif
</div>

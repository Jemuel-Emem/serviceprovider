<div>
    <!-- Select dropdown to choose service provider -->
    <div class="mb-4">
        <select wire:model="selectedServiceProvider" class="border border-gray-300 rounded-md p-2 w-full">
            <option value="">Select Service Provider</option>
            @foreach($serviceProviders as $provider)
                <option value="{{ $provider->id }}">{{ $provider->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Button to load chat form and messages -->
    <div class="mb-4">
        <button wire:click="loadMessages" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Load Chat</button>
    </div>

    <!-- Display messages if a service provider is selected and loaded -->
    @if($selectedServiceProvider && !empty($messages))
        <div class="mb-4">
            @foreach($messages as $message)
                <div>
                    <strong>{{ $message->from_client ? 'Client' : 'Service Provider' }}:</strong>
                    <p>{{ $message->message }}</p>
                </div>
            @endforeach
        </div>

        <!-- Form to send new message -->
        <form wire:submit.prevent="sendMessage">
            <input type="text" wire:model="newMessage" placeholder="Type your message..." class="border border-gray-300 rounded-md p-2 w-full">
            <button type="submit" class="mt-2 bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Send</button>
        </form>
    @elseif($selectedServiceProvider)
        <p class="mt-4">No messages found. Start a conversation by sending a message.</p>
    @else
        <p class="mt-4">Select a service provider and click "Load Chat" to start chatting.</p>
    @endif

    <!-- Flash Message -->
    @if(session()->has('message'))
        <div class="fixed bottom-0 right-0 p-4">
            <div class="bg-red-500 text-white p-4 rounded-md shadow-md">
                {{ session('message') }}
            </div>
        </div>
    @endif
</div>

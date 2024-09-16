<div class="flex flex-col md:flex-row  h-screen" style="margin-right: 200px;">
    <!-- User List on the Left -->
    <div class="w-full  lg:w-1/4 bg-indigo-900 p-6 border-b md:border-r border-gray-300 overflow-y-auto" style="width: 200px;">
        <h2 class="text-4xl font-bold mb-6 text-white">Clients</h2>
        <ul>
            @foreach($users as $user)
                <li class="mb-4">
                    <button wire:click="selectUser({{ $user->id }})"
                            class="w-full flex items-center px-4 py-3 rounded-lg hover:bg-indigo-50 transition duration-150 ease-in-out
                            {{ $user->id === $selectedUser ? 'bg-indigo-100 text-indigo-700' : 'text-white' }}">
                        {{-- <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="w-12 h-12 rounded-full mr-4"> --}}
                        <span class="text-lg font-semibold">{{ $user->name }}</span>
                    </button>
                </li>
            @endforeach
        </ul>
    </div>


    <div class="w-full md:w-2/3 lg:w-3/4 p-6 flex flex-col bg-white border-t md:border-t-0 border-gray-300 ml-80" style="width: 800px;">

        <div class="flex items-center justify-between border-b border-gray-300 pb-4 mb-6">
            <h3 class="text-3xl font-semibold text-indigo-800">
                @if($selectedUser)
                    Chat with {{ $users->find($selectedUser)->name }}
                @else
                    Select a user to start chatting
                @endif
            </h3>
        </div>

        <!-- Display messages -->
        <div class="flex-1 overflow-y-auto mb-6 p-4  bg-gray-50 rounded-lg border border-gray-300 max-h-[calc(100vh-200px)]">
            @foreach($messages as $message)
                <div class="mb-4 flex {{ $message->from_client ? 'justify-end' : 'justify-start' }}">
                    <div class="w-9/12 p-4 rounded-lg {{ $message->from_client ? 'bg-blue-500 text-white' : 'bg-gray-300 text-gray-800' }} max-w-[70%]">
                        <p >{{ $message->message }}</p>
                        <span class="text-xs text-gray-600">{{ $message->created_at->format('H:i') }}</span>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Form to send new message -->
        @if($selectedUser)
            <form wire:submit.prevent="sendMessage" class="flex items-center space-x-4 mt-6">
                <input type="text" wire:model="newMessage" placeholder="Type your message..." class="flex-1 border border-gray-300 rounded-md p-4 text-lg focus:outline-none focus:border-indigo-500 transition duration-150 ease-in-out">
                <button type="submit" class="bg-indigo-600 text-white px-6 py-3 rounded-md hover:bg-indigo-700 transition duration-150 ease-in-out text-lg">Send</button>
            </form>
        @else
            <p class="text-gray-500 text-lg">Select a user to start chatting.</p>
        @endif

        <!-- Flash Message -->
        @if(session()->has('message'))
            <div class="mt-6 bg-red-500 text-white p-4 rounded-md">
                {{ session('message') }}
            </div>
        @endif
    </div>
</div>

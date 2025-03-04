<?php
use Livewire\WithFileUploads;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;

use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    use WithFileUploads;
    public string $name = '';
    public string $phonenumber = '';
    public string $address = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public $id_photo; // For handling the ID photo upload

    public string $role = '';  // Role selection for Service Provider or Client

    /**
     * Handle an incoming registration request.
     */
     public function register(): void
    {
        // Validate the form data, including the file
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'phonenumber' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:service_provider,client'],
            'id_photo' => ['nullable', 'image', 'max:1024'], // Validate the ID photo (optional)
        ]);

        // Store the ID photo if the role is 'service_provider'
         if ($this->role === 'service_provider' && $this->id_photo) {
            $validated['id_photo'] = $this->id_photo->store('id_photos', 'public'); // Store the file in 'storage/app/public/id_photos'
         }


        // Hash the password
        $validated['password'] = Hash::make($validated['password']);

        // Assign numeric value for role (2 for Service Provider, 0 for Client)
        $validated['role'] = $this->role === 'service_provider' ? 2 : 0;

        // Create a new user with the validated data
        event(new Registered($user = User::create($validated)));
        if ($this->role === 'service_provider') {
        $message = "YOU ARE SUCCESSFULLY REGISTERED. WAIT FOR THE APPROVAL OF ADMIN.";
        $this->sendSMS($user->phonenumber, $message);
    }
        // Log the user in
        Auth::login($user);

        // Redirect the user to the home page
        $this->redirect(RouteServiceProvider::HOME, navigate: true);
    }

    private function sendSMS($phoneNumber, $message)
{
    $ch = curl_init();

    $parameters = array(
        'apikey' => '046125f45f4f187e838905df98273c4e', // Replace with your actual API key
        'number' => $phoneNumber,
        'message' => $message,
        'sendername' => 'Estanz'
    );

    curl_setopt($ch, CURLOPT_URL, 'https://semaphore.co/api/v4/messages');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $output = curl_exec($ch);
    curl_close($ch);
}

};
?>

<div>
    <form wire:submit="register" enctype="multipart/form-data">
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Full Name')" />
            <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="phonenumber" :value="__('Phone Number')" />
            <x-text-input wire:model="phonenumber" id="phonenumber" class="block mt-1 w-full" type="text" name="phonenumber" required autofocus autocomplete="phonenumber" />
            <x-input-error :messages="$errors->get('phonenumber')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="address" :value="__('Address')" />
            <x-text-input wire:model="address" id="address" class="block mt-1 w-full" type="text" address="address" required autofocus autocomplete="address" />
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>
        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input wire:model="password" id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Role Select -->
        <div class="mt-4">
            <x-input-label for="role" :value="__('Select Role')" />
            <select wire:model="role" id="role" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" onchange="toggleIdUpload()">
                <option value="">{{ __('Choose a role') }}</option>
                <option value="service_provider">{{ __('Service Provider') }}</option>
                <option value="client">{{ __('Client') }}</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- ID Photo Upload (Visible only for Service Provider role) -->
        <div id="id-upload" class="mt-4 hidden">
            <x-input-label for="id_photo" :value="__('Upload ID Photo')" />
            <input type="file" wire:model="id_photo" id="id_photo" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
            <x-input-error :messages="$errors->get('id_photo')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}" wire:navigate>
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</div>

<!-- JavaScript for showing/hiding ID photo upload -->
<script>
    function toggleIdUpload() {
        var role = document.getElementById('role').value;
        var idUpload = document.getElementById('id-upload');

        if (role === 'service_provider') {
            idUpload.classList.remove('hidden');
        } else {
            idUpload.classList.add('hidden');
        }
    }
</script>


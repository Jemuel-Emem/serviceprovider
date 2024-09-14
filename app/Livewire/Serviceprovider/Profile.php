<?php

namespace App\Livewire\Serviceprovider;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Profile extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $gcashname;
    public $gcashnumber;
    public $id_photo;
    public $existing_id_photo;

    public function mount()
    {
        $user = Auth::user();  // Fetch the authenticated user

        // Initialize the component properties with user data
        $this->name = $user->name;
        $this->email = $user->email;
        $this->gcashname = $user->gcashname;
        $this->gcashnumber = $user->gcashnumber;
        $this->existing_id_photo = $user->id_photo;  // For displaying the current profile photo
    }

    public function updateProfile()
    {
        // Fetch the authenticated user from the database
        $user = \App\Models\User::find(auth()->id());

        // Validate input fields
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'gcashname' => 'nullable|string|max:255',
            'gcashnumber' => 'nullable|string|max:20',
            'id_photo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        // Update the user's information
        $user->name = $this->name;
        $user->email = $this->email;
        $user->gcashname = $this->gcashname;
        $user->gcashnumber = $this->gcashnumber;

        // Handle the photo upload
        if ($this->id_photo) {
            // Delete the old photo if it exists
            if ($this->existing_id_photo) {
                Storage::delete('public/' . $this->existing_id_photo);
            }
            // Store the new photo and update the user
            $user->id_photo = $this->id_photo->store('profile_photos', 'public');
        }

        // Save the updated user back to the database
        $user->save();

        // Refresh the component with updated data
        $this->mount();

        // Flash a success message
        session()->flash('message', 'Profile updated successfully!');
    }

    public function render()
    {
        return view('livewire.serviceprovider.profile');
    }
}

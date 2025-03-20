<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class ServiceProvider extends Component
{
    // public function approve($userId)
    // {
    //     $user = User::find($userId);
    //     if ($user) {
    //         $user->serviceproviderstatus = 'approved';
    //         $user->save();
    //     }
    // }

    // public function decline($userId)
    // {
    //     $user = User::find($userId);
    //     if ($user) {
    //         $user->serviceproviderstatus = 'declined';
    //         $user->save();
    //     }
    // }

    public function approve($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $user->serviceproviderstatus = 'approved';
            $user->save();

            $message = "YOUR REGISTRATION HAS BEEN APPROVED. YOU ARE SUCCESSFULLY REGISTERED.";
            $this->sendSMS($user->phonenumber, $message);
        }
    }

    public function decline($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $user->serviceproviderstatus = 'declined';
            $user->save();

            // Send SMS notification
            $message = "YOUR REGISTRATION HAS BEEN DECLINED. PLEASE CONTACT ADMIN FOR MORE DETAILS.";
            $this->sendSMS($user->phonenumber, $message);
        }
    }
    private function sendSMS($phoneNumber, $message)
    {
        $ch = curl_init();

        $parameters = [
            'apikey' => '046125f45f4f187e838905df98273c4e', // Replace with your actual API key
            'number' => $phoneNumber,
            'message' => $message,
            'sendername' => 'Estanz'
        ];

        curl_setopt($ch, CURLOPT_URL, 'https://semaphore.co/api/v4/messages');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $output = curl_exec($ch);
        curl_close($ch);
    }
    public function render()
    {
        $serviceProviders = User::where('role', 2)->get();
        return view('livewire.admin.service-provider', compact('serviceProviders'));
    }
}

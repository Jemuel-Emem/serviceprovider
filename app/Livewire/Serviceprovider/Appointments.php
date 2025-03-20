<?php

namespace App\Livewire\Serviceprovider;

use App\Models\Appointment;
use Livewire\Component;
use Livewire\WithPagination;

class Appointments extends Component
{
    use WithPagination;

    public $search = '';
    public $showDeclineModal = false;
    public $declineMessage = '';
    public $appointmentIdToDecline;

    public function render()
    {
        $serviceProviderId = auth()->id();

        $appointments = Appointment::where('serviceprovider_id', $serviceProviderId)
            ->when($this->search, function ($query) {
                $query->where('servicename', 'like', "%{$this->search}%")
                    ->orWhere('status', 'like', "%{$this->search}%");
            })
            ->paginate(10);

        return view('livewire.serviceprovider.appointments', [
            'appointments' => $appointments,
        ]);
    }

    // public function approveAppointment($appointmentId)
    // {
    //     $appointment = Appointment::find($appointmentId);

    //     if ($appointment) {
    //         $appointment->status = 'completed';
    //         $appointment->save();
    //         $message = "Your appointment for {$appointment->servicename} on {$appointment->dateofappointment} has been APPROVED. Thank you!";
    //     }
    // }

    // public function declineAppointment($appointmentId)
    // {
    //     $appointment = Appointment::find($appointmentId);

    //     if ($appointment) {
    //         $appointment->status = 'canceled';
    //         $appointment->save();


    //         $this->sendSMS($appointment->phonenumber, "We regret to inform you that your appointment for {$appointment->servicename} has been declined.");
    //     }
    // }

    // public function approveAppointment($appointmentId)
    // {
    //     $appointment = Appointment::find($appointmentId);
    //     $serviceProvider = auth()->user();

    //     if ($appointment) {
    //         $appointment->status = 'completed';
    //         $appointment->save();

    //         $clientMessage = "Your appointment for {$appointment->servicename} on {$appointment->dateofappointment} has been APPROVED. Thank you!";
    //         $providerMessage = "You have an approved appointment for {$appointment->servicename} with {$appointment->client_name} on {$appointment->dateofappointment}.";


    //         $this->sendSMS($appointment->phonenumber, $clientMessage);


    //         if ($serviceProvider->phonenumber) {
    //             $this->sendSMS($serviceProvider->phonenumber, $providerMessage);
    //         }
    //     }
    // }


    public function approveAppointment($appointmentId)
{
    $appointment = Appointment::find($appointmentId);
    $serviceProvider = auth()->user();

    if ($appointment) {
        $appointment->status = 'completed';
        $appointment->save();

        // Update service status to 'unavailable'
        $service = $serviceProvider->services()->where('service_name', $appointment->servicename)->first();
        if ($service) {
            $service->status = 'unavailable';
            $service->save();
        }

        $clientMessage = "Your appointment for {$appointment->servicename} on {$appointment->dateofappointment} has been APPROVED. Thank you!";
        $providerMessage = "You have an approved appointment for {$appointment->servicename} with {$appointment->client_name} on {$appointment->dateofappointment}.";

        $this->sendSMS($appointment->phonenumber, $clientMessage);

        if ($serviceProvider->phonenumber) {
            $this->sendSMS($serviceProvider->phonenumber, $providerMessage);
        }
    }
}

    public function declineAppointment($appointmentId)
    {
        $appointment = Appointment::find($appointmentId);
        $serviceProvider = auth()->user();

        if ($appointment) {
            $appointment->status = 'canceled';
            $appointment->save();

            $clientMessage = "We regret to inform you that your appointment for {$appointment->servicename} has been declined.";
            $providerMessage = "You have declined an appointment for {$appointment->servicename} with {$appointment->client_name}.";


            $this->sendSMS($appointment->phonenumber, $clientMessage);


            if ($serviceProvider->phonenumber) {
                $this->sendSMS($serviceProvider->phonenumber, $providerMessage);
            }
        }
    }


    public function printReceipt($appointmentId)
    {
        return redirect()->route('appointments.printReceipt', ['appointment' => $appointmentId]);
    }
    private function sendSMS($phoneNumber, $message)
    {
        $ch = curl_init();

        $parameters = array(
            'apikey' => '046125f45f4f187e838905df98273c4e',
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
    public function closeDeclineModal()
    {
        $this->showDeclineModal = false;
        $this->declineMessage = '';  // Reset the message
    }
}

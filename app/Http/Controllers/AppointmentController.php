<?php

namespace App\Http\Controllers;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function printReceipt(Appointment $appointment)
    {
        return view('appointment.reciept', compact('appointment'));
    }
}

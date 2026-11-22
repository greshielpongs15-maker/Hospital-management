<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'patient_id'       => ['required', 'exists:patients,id'],
            'doctor_id'        => ['required', 'exists:doctors,id'],
            'appointment_date' => ['required', 'date', 'after_or_equal:today'],
            'appointment_time' => ['required', 'date_format:H:i'],
            'reason'           => ['nullable', 'string'],
        ]);

        // Same doctor, same slot = duplicate
        $taken = Appointment::where('doctor_id', $data['doctor_id'])
            ->whereDate('appointment_date', $data['appointment_date'])
            ->whereTime('appointment_time', $data['appointment_time'])
            ->exists();

        if ($taken) {
            return back()->withInput()->withErrors(['appointment_time' => 'This doctor already has an appointment at that time.']);
        }

        Appointment::create($data); // status defaults to "Scheduled" in your migration

        return redirect()->route('dashboard')->with('success', 'Appointment booked.');
    }
}

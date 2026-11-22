<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Consultation;
use App\Models\Doctor;
use App\Models\Patient;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'stats' => [
                'patients'      => Patient::count(),
                'doctors'       => Doctor::count(),
                'today'         => Appointment::whereDate('appointment_date', today())->count(),
                'consultations' => Consultation::count(),
            ],
            // Eager loading uses your belongsTo / hasOne relationships (no N+1 queries)
            'appointments' => Appointment::with(['patient', 'doctor'])
                ->whereDate('appointment_date', '>=', today())
                ->orderBy('appointment_date')->orderBy('appointment_time')
                ->limit(6)->get(),
            'patients' => Patient::with('patientRecord')->latest()->limit(6)->get(),
            'consultations' => Consultation::with(['patient', 'doctor'])->latest('consultation_date')->limit(5)->get(),
            'allPatients' => Patient::orderBy('name')->get(['id', 'name']),
            'allDoctors'  => Doctor::orderBy('name')->get(['id', 'name', 'specialization']),
        ]);
    }
}

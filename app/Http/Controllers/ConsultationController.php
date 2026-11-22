<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    public function store(Request $request)
    {
        Consultation::create($request->validate([
            'patient_id'        => ['required', 'exists:patients,id'],
            'doctor_id'         => ['required', 'exists:doctors,id'],
            'consultation_date' => ['required', 'date', 'before_or_equal:today'],
            'diagnosis'         => ['nullable', 'string'],
            'treatment'         => ['nullable', 'string'],
        ]));

        return redirect()->route('dashboard')->with('success', 'Consultation recorded.');
    }
}

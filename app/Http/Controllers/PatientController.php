<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class PatientController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'            => ['required', 'string', 'max:255'],
            'age'             => ['required', 'integer', 'min:0', 'max:130'],
            'gender'          => ['required', 'in:Male,Female,Other'],
            'contact_number'  => ['required', 'string', 'max:30'],
            'address'         => ['required', 'string'],
            'blood_type'      => ['nullable', 'string', 'max:5'],
            'allergies'       => ['nullable', 'string'],
            'medical_history' => ['nullable', 'string'],
        ]);

        // Patient + PatientRecord are saved together or not at all (hasOne relationship)
        DB::transaction(function () use ($data) {
            $patient = Patient::create(Arr::only($data, ['name', 'age', 'gender', 'contact_number', 'address']));
            $patient->patientRecord()->create(Arr::only($data, ['blood_type', 'allergies', 'medical_history']));
        });

        return redirect()->route('dashboard')->with('success', 'Patient added.');
    }
}

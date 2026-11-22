<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function store(Request $request)
    {
        Doctor::create($request->validate([
            'name'           => ['required', 'string', 'max:255'],
            'specialization' => ['required', 'string', 'max:255'],
            'contact_number' => ['required', 'string', 'max:30'],
            'email'          => ['required', 'email', 'max:255', 'unique:doctors,email'],
        ]));

        return redirect()->route('dashboard')->with('success', 'Doctor added.');
    }
}

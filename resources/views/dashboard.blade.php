@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
@php
    $h = now()->format('H');
    $hello = $h < 12 ? 'Good morning' : ($h < 18 ? 'Good afternoon' : 'Good evening');
    $open = old('_form', 'patient');
@endphp

@if (session('success')) <div class="toast ok">{{ session('success') }}</div> @endif
@if (session('error'))   <div class="toast bad">{{ session('error') }}</div> @endif

<section class="glass hello">
    <p class="eyebrow">{{ now()->format('l, F j') }}</p>
    <h1>{{ $hello }}, {{ \Illuminate\Support\Str::before(auth()->user()->name, ' ') }}.</h1>
</section>

<section class="stats">
    <div class="glass stat"><b>{{ $stats['patients'] }}</b><span>Patients</span></div>
    <div class="glass stat"><b>{{ $stats['doctors'] }}</b><span>Doctors</span></div>
    <div class="glass stat"><b>{{ $stats['today'] }}</b><span>Appointments today</span></div>
    <div class="glass stat"><b>{{ $stats['consultations'] }}</b><span>Consultations</span></div>
</section>

<div class="grid">
    <div class="col">
        <section class="glass panel">
            <h2>Upcoming appointments</h2>
            @forelse ($appointments as $a)
                <div class="row">
                    <div class="when">{{ \Carbon\Carbon::parse($a->appointment_date)->format('M j') }}<small>{{ \Carbon\Carbon::parse($a->appointment_time)->format('g:i A') }}</small></div>
                    <div class="grow"><b>{{ $a->patient->name }}</b><small>with Dr. {{ $a->doctor->name }} · {{ $a->doctor->specialization }}</small></div>
                    <span class="pill">{{ $a->status }}</span>
                </div>
            @empty <p class="empty">Nothing scheduled yet.</p> @endforelse
        </section>

        <section class="glass panel">
            <h2>Recent patients</h2>
            @forelse ($patients as $p)
                <div class="row">
                    <div class="grow"><b>{{ $p->name }}</b><small>{{ $p->age }} · {{ $p->gender }} · {{ $p->contact_number }}</small></div>
                    <span class="pill soft">{{ $p->patientRecord?->blood_type ?? '—' }}</span>
                </div>
            @empty <p class="empty">No patients yet.</p> @endforelse
        </section>

        <section class="glass panel">
            <h2>Latest consultations</h2>
            @forelse ($consultations as $c)
                <div class="row">
                    <div class="grow"><b>{{ $c->patient->name }}</b><small>{{ $c->diagnosis ?: 'No diagnosis noted' }} · Dr. {{ $c->doctor->name }}</small></div>
                    <small>{{ \Carbon\Carbon::parse($c->consultation_date)->format('M j') }}</small>
                </div>
            @empty <p class="empty">No consultations yet.</p> @endforelse
        </section>
    </div>

    <aside class="glass panel add" data-open="{{ $open }}">
        <h2>Quick add</h2>
        <div class="tabs">
            <button type="button" data-tab="patient">Patient</button>
            <button type="button" data-tab="doctor">Doctor</button>
            <button type="button" data-tab="appointment">Appointment</button>
            <button type="button" data-tab="consultation">Consult</button>
        </div>

        @if ($errors->any())
            <div class="notice warn"><ul>@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
        @endif

        {{-- PATIENT (+ PatientRecord) --}}
        <form class="pane" data-pane="patient" method="POST" action="{{ route('patients.store') }}">
            @csrf <x-once /> <input type="hidden" name="_form" value="patient">
            <label>Name <input name="name" value="{{ old('_form') === 'patient' ? old('name') : '' }}"></label>
            <div class="two">
                <label>Age <input type="number" name="age" min="0" value="{{ old('_form') === 'patient' ? old('age') : '' }}"></label>
                <label>Gender <select name="gender"><option>Male</option><option>Female</option><option>Other</option></select></label>
            </div>
            <label>Contact number <input name="contact_number" value="{{ old('_form') === 'patient' ? old('contact_number') : '' }}"></label>
            <label>Address <textarea name="address" rows="2">{{ old('_form') === 'patient' ? old('address') : '' }}</textarea></label>
            <label>Blood type <input name="blood_type" placeholder="e.g. O+"></label>
            <label>Allergies <textarea name="allergies" rows="2"></textarea></label>
            <label>Medical history <textarea name="medical_history" rows="2"></textarea></label>
            <button class="btn block" type="submit">Save patient</button>
        </form>

        {{-- DOCTOR --}}
        <form class="pane" data-pane="doctor" method="POST" action="{{ route('doctors.store') }}">
            @csrf <x-once /> <input type="hidden" name="_form" value="doctor">
            <label>Name <input name="name" value="{{ old('_form') === 'doctor' ? old('name') : '' }}"></label>
            <label>Specialization <input name="specialization" value="{{ old('_form') === 'doctor' ? old('specialization') : '' }}"></label>
            <label>Contact number <input name="contact_number" value="{{ old('_form') === 'doctor' ? old('contact_number') : '' }}"></label>
            <label>Email <input type="email" name="email" value="{{ old('_form') === 'doctor' ? old('email') : '' }}"></label>
            <button class="btn block" type="submit">Save doctor</button>
        </form>

        {{-- APPOINTMENT --}}
        <form class="pane" data-pane="appointment" method="POST" action="{{ route('appointments.store') }}">
            @csrf <x-once /> <input type="hidden" name="_form" value="appointment">
            <label>Patient <select name="patient_id">@foreach ($allPatients as $p)<option value="{{ $p->id }}" @selected(old('patient_id') == $p->id)>{{ $p->name }}</option>@endforeach</select></label>
            <label>Doctor <select name="doctor_id">@foreach ($allDoctors as $d)<option value="{{ $d->id }}" @selected(old('doctor_id') == $d->id)>Dr. {{ $d->name }} — {{ $d->specialization }}</option>@endforeach</select></label>
            <div class="two">
                <label>Date <input type="date" name="appointment_date" min="{{ today()->toDateString() }}" value="{{ old('appointment_date') }}"></label>
                <label>Time <input type="time" name="appointment_time" value="{{ old('appointment_time') }}"></label>
            </div>
            <label>Reason <textarea name="reason" rows="2">{{ old('reason') }}</textarea></label>
            <button class="btn block" type="submit">Book appointment</button>
        </form>

        {{-- CONSULTATION --}}
        <form class="pane" data-pane="consultation" method="POST" action="{{ route('consultations.store') }}">
            @csrf <x-once /> <input type="hidden" name="_form" value="consultation">
            <label>Patient <select name="patient_id">@foreach ($allPatients as $p)<option value="{{ $p->id }}">{{ $p->name }}</option>@endforeach</select></label>
            <label>Doctor <select name="doctor_id">@foreach ($allDoctors as $d)<option value="{{ $d->id }}">Dr. {{ $d->name }}</option>@endforeach</select></label>
            <label>Date <input type="date" name="consultation_date" max="{{ today()->toDateString() }}" value="{{ today()->toDateString() }}"></label>
            <label>Diagnosis <textarea name="diagnosis" rows="2"></textarea></label>
            <label>Treatment <textarea name="treatment" rows="2"></textarea></label>
            <button class="btn block" type="submit">Save consultation</button>
        </form>
    </aside>
</div>
@endsection

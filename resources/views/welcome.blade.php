@extends('layouts.guest')
@section('title', 'Welcome')
@section('content')
<section class="card hero">
    <p class="eyebrow">Patient care, made calm</p>
    <h1>{{ config('app.name') }}</h1>
    <p class="lead">Patients, appointments and consultations, gently organised in one quiet place.</p>
    <div class="actions">
        <a class="btn" href="{{ route('login') }}">Sign in</a>
        <a class="btn ghost" href="{{ route('register') }}">Create account</a>
    </div>
</section>
@endsection

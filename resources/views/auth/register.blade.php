@extends('layouts.guest')
@section('title', 'Create account')
@section('content')
<section class="card">
    <h1>Create your account</h1>
    <p class="lead">It only takes a moment.</p>

    @if (session('error')) <div class="notice warn">{{ session('error') }}</div> @endif

    <form method="POST" action="{{ route('register') }}" novalidate>
        @csrf
        <x-once />
        <label>Full name
            <input type="text" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>
        </label>
        @error('name') <p class="err">{{ $message }}</p> @enderror

        <label>Email
            <input type="email" name="email" value="{{ old('email') }}" autocomplete="email">
        </label>
        @error('email') <p class="err">{{ $message }}</p> @enderror

        <label>Password
            <span class="pass">
                <input type="password" id="password" name="password" autocomplete="new-password">
                <button type="button" class="link" data-toggle-pass="password">Show</button>
            </span>
        </label>
        @error('password') <p class="err">{{ $message }}</p> @enderror

        <label>Confirm password
            <input type="password" name="password_confirmation" autocomplete="new-password">
        </label>

        <button class="btn block" type="submit">Create account</button>
    </form>

    <p class="foot">Already registered? <a href="{{ route('login') }}">Sign in</a></p>
</section>
@endsection

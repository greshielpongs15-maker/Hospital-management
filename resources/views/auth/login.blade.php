@extends('layouts.guest')
@section('title', 'Sign in')
@section('content')
<section class="card">
    <h1>Welcome back</h1>
    <p class="lead">Sign in to continue.</p>

    @if (session('lockout'))
        <div class="notice warn" data-lockout="{{ session('lockout') }}">
            Too many attempts. Try again in <b data-count>{{ session('lockout') }}</b>s.
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" novalidate>
        @csrf
        <label>Email
            <input type="email" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
        </label>
        @error('email') <p class="err">{{ $message }}</p> @enderror

        <label>Password
            <span class="pass">
                <input type="password" id="password" name="password" autocomplete="current-password">
                <button type="button" class="link" data-toggle-pass="password">Show</button>
            </span>
        </label>
        @error('password') <p class="err">{{ $message }}</p> @enderror

        <label class="check"><input type="checkbox" name="remember"> Keep me signed in</label>

        <button class="btn block" type="submit" data-lock-btn>Sign in</button>
    </form>

    <p class="foot">New here? <a href="{{ route('register') }}">Create an account</a></p>
</section>
@endsection

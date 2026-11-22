<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    private const MAX_PER_ACCOUNT = 5;    // wrong passwords per email+IP
    private const MAX_PER_IP      = 20;   // guessing across many emails from one IP
    private const LOCK_SECONDS    = 300;  // 5 minutes

    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        $accountKey = 'login:' . Str::lower($credentials['email']) . '|' . $request->ip();
        $ipKey      = 'login-ip:' . $request->ip();

        // Locked out? Reject BEFORE checking the password so it can't be guessed while locked.
        foreach ([$accountKey => self::MAX_PER_ACCOUNT, $ipKey => self::MAX_PER_IP] as $key => $max) {
            if (RateLimiter::tooManyAttempts($key, $max)) {
                $seconds = RateLimiter::availableIn($key);

                return back()
                    ->withInput($request->only('email'))
                    ->with('lockout', $seconds);
            }
        }

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            RateLimiter::clear($accountKey);
            $request->session()->regenerate();   // prevents session fixation

            return redirect()->intended(route('dashboard'));
        }

        RateLimiter::hit($accountKey, self::LOCK_SECONDS);
        RateLimiter::hit($ipKey, self::LOCK_SECONDS);

        $left = max(0, self::MAX_PER_ACCOUNT - RateLimiter::attempts($accountKey));

        if ($left === 0) {
            return back()->withInput($request->only('email'))
                ->with('lockout', RateLimiter::availableIn($accountKey));
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => "These credentials don't match our records. {$left} " . Str::plural('attempt', $left) . ' left.']);
    }

    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

/**
 * One-time form tokens: every form renders <x-once /> which stores a token in the session.
 * The token can be used exactly once, so double-clicks, double-taps, or replayed
 * requests never create duplicate rows.
 */
class PreventDoubleSubmit
{
    public function handle(Request $request, Closure $next): Response
    {
        $token  = (string) $request->input('_once');
        $tokens = $request->session()->get('once_tokens', []);

        // Atomic lock: stops two simultaneous requests carrying the same token
        $lock = $token ? Cache::lock('once:' . $token, 10) : null;

        if (! $token || ! in_array($token, $tokens, true) || ! $lock->get()) {
            return redirect()->back()->with('error', 'That form was already submitted. Nothing was duplicated.');
        }

        $request->session()->put('once_tokens', array_values(array_diff($tokens, [$token])));

        return $next($request);
    }
}

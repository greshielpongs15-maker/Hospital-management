@php
    $token = \Illuminate\Support\Str::random(40);
    session()->push('once_tokens', $token);
    session()->put('once_tokens', array_slice(session('once_tokens', []), -30)); // keep the list small
@endphp
<input type="hidden" name="_once" value="{{ $token }}">

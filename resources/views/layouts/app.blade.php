<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') · {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,600&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="dash">
    <div class="shell">
        <header class="bar glass">
            <a class="brand" href="{{ route('dashboard') }}"> {{ config('app.name') }}</a>
            <div class="who">
                <span>{{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">@csrf
                    <button class="btn ghost sm" type="submit">Sign out</button>
                </form>
            </div>
        </header>
        @yield('content')
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="{{ route('services.index') }}">Services</a></li>
                @if (Auth::user()->is_admin)
                <li><a href="{{ route('transactions.index') }}">Transactions</a></li>
                <li><a href="{{ route('kyc.index') }}">Manage KYC</a></li>


                @endif
                <li><a href="{{ route('logout') }}">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="container">
            @yield('content')
        </div>
    </main>
</body>
</html>

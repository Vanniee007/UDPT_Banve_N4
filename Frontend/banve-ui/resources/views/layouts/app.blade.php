<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Your Application')</title>
    <link rel="stylesheet" href="{{ asset('frontend/css/app.css') }}">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    @stack('styles') <!-- Đảm bảo stack styles được sử dụng ở đây -->
</head>
<body>
    <header class="header">
        @include('layouts.header')
    </header>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12 custom-content">
                @yield('content')
            </div>
        </div>
    </div>

    <footer class="footer">
        @include('layouts.footer')
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    @stack('scripts') <!-- Đảm bảo stack scripts được sử dụng ở đây -->
</body>
</html>

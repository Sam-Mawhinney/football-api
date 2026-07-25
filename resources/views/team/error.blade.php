<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Fixtures unavailable</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<main class="container py-5">
    <div class="card shadow-sm mx-auto" style="max-width: 550px">
        <div class="card-body p-4 text-center">
            <h1 class="h3">Fixtures currently unavailable</h1>

            <p class="text-muted">
                {{ $message ?? 'We could not retrieve the football data. Please try again shortly.' }}
            </p>

            <a href="{{ url('/') }}" class="btn btn-danger">
                Try again
            </a>
        </div>
    </div>
</main>
</body>
</html>

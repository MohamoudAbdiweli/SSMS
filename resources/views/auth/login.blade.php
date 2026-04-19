<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SACCO MS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
</head>

<body class="bg-gray-100">

    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-10 rounded-2xl shadow-md w-full max-w-md">
            <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>

            @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="/login" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="w-full border p-2 rounded"
                        placeholder="Enter your email">
                </div>

                <div class="mb-4">
                    <label class="block mb-1">Password</label>
                    <input type="password" name="password" class="w-full border p-2 rounded"
                        placeholder="Enter password">
                </div>

                <button type="submit" class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700 transition">
                    Login
                </button>

                <p class="mt-4 text-center text-gray-500">
                    Don't have an account? <a href="/register" class="text-green-600">Register</a>
                </p>
            </form>
        </div>
    </div>

</body>

</html>
{{-- resources/views/home.blade.php --}}
<!DOCTYPE html>
<html lang="nl">
<head>
    <title>Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white font-sans flex flex-col justify-center items-center min-h-screen m-0">
    <div class="bg-gray-800 px-12 py-8 rounded-xl shadow-lg text-center">
        <h1 class="text-4xl font-extrabold mb-4 text-white">Welkom op de Homepagina!</h1>
        <p class="mb-6 text-lg text-gray-200">Dit is de startpagina van je applicatie. Log in of registreer om verder te gaan naar de dashboard.</p>
        <div class="flex justify-center gap-6 mt-6">
            <a href="{{ route('login') }}" class="bg-gray-900 hover:bg-teal-600 text-white font-bold py-2 px-6 rounded-lg shadow transition">Inloggen</a>
            <a href="{{ route('register') }}" class="bg-gray-900 hover:bg-blue-600 text-white font-bold py-2 px-6 rounded-lg shadow transition">Registreren</a>
        </div>
    </div>
</body>
</html>

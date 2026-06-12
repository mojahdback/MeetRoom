<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>MeetRoom — Connexion</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gray-100 flex items-center justify-center">

    <div class="bg-white rounded-2xl shadow-md p-8 w-full max-w-sm">

        <h1 class="text-2xl font-bold text-gray-800 mb-1">Connexion</h1>
        <p class="text-sm text-gray-400 mb-6">MeetRoom · Nexora Solutions</p>

      <form method="POST" action="{{ route('login') }}"> 
        <form class="space-y-4">
             @csrf

            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Adresse e-mail</label>
                <input type="email" name="email" placeholder="vous@nexora.ma"
                       class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition"/>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Mot de passe</label>
                <input type="password" name="password" id="password" placeholder="••••••••"
                       class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition"/>
               
            </div>

            <button type="submit"
                    class="mt-8 w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2.5 rounded-lg text-sm transition ">
                Se connecter
            </button>

        </form>

        <p class="text-center text-sm text-gray-400 mt-5">
            Pas de compte ?
             <a href="{{ route('register') }}" 
            <a href="#" class="text-blue-500 font-medium hover:underline">S'inscrire</a>
        </p>

    </div>

</body>
</html>

<script>
    function togglePass() {
        const p = document.getElementById('password');
        p.type = p.type === 'password' ? 'text' : 'password';
    }
</script>
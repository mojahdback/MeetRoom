<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Nouveau Bâtiment — MeetRoom</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 min-h-screen">

    <div class="max-w-xl mx-auto py-10 px-4">

        <!-- Back -->
        <a href="{{ route('admin.buildings.index') }}" <a href="index.blade.php"
            class="inline-flex items-center gap-1 text-sm text-gray-400 hover:text-gray-600 mb-6 transition">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M15 18l-6-6 6-6" />
            </svg>
            Retour aux bâtiments
        </a>

        <div class="bg-white rounded-2xl shadow-sm p-8">

            <h1 class="text-xl font-bold text-gray-800 mb-1">Nouveau bâtiment</h1>
            <p class="text-sm text-gray-400 mb-6">Ajouter un bâtiment au parc immobilier</p>

            <form method="POST" action="{{ route('admin.buildings.store') }}" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Nom du bâtiment</label>
                    <input type="text" name="name" placeholder="ex : Siège Social"
                        class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition" />
                    @error('name') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Adresse</label>
                    <input type="text" name="address" placeholder="ex : 12 Rue Hassan II, Casablanca"
                        class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition" />
                    @error('address') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Nombre d'étages</label>
                    <input type="number" name="floors_count" placeholder="ex : 5" min="1"
                        class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition" />
                    @error('floors_count') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center gap-2">
                    <input type="checkbox" name="is_active" id="is_active" value="1" checked
                        class="accent-blue-500 w-4 h-4" />
                    <label for="is_active" class="text-sm text-gray-600 cursor-pointer">Bâtiment actif</label>
                </div>

                <div class="flex gap-3 pt-2">
                    <a href="{{ route('admin.buildings.index') }}" <a href="index.blade.php"
                        class="flex-1 text-center border border-gray-200 rounded-lg py-2.5 text-sm text-gray-500 hover:bg-gray-50 transition">
                        Annuler
                    </a>
                    <button type="submit"
                        class="flex-1 bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2.5 rounded-lg text-sm transition">
                        Enregistrer
                    </button>
                </div>

            </form>
        </div>

    </div>
</body>

</html>
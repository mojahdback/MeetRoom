<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Modifier Bâtiment</title>
 @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 min-h-screen p-8">

    <div class="max-w-lg mx-auto">

        <a href="{{ route('admin.buildings.index') }}" class="text-sm text-gray-400 hover:text-gray-600 mb-6 inline-block">
            ← Retour
        </a>

        <div class="bg-white rounded-2xl shadow-sm p-8">

            <h1 class="text-xl font-bold text-gray-800 mb-6">Modifier le bâtiment</h1>

            <form method="POST" action="{{ route('admin.buildings.update', $building) }}" class="space-y-4">
                @csrf
                @method('PATCH')

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Nom</label>
                    <input type="text" name="name" value="{{ old('name', $building->name) }}"
                           class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-100"/>
                    @error('name') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Adresse</label>
                    <input type="text" name="address" value="{{ old('address', $building->address) }}"
                           class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-100"/>
                    @error('address') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Nombre d'étages</label>
                    <input type="number" name="floors_count" value="{{ old('floors_count', $building->floors_count) }}" min="1"
                           class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-100"/>
                    @error('floors_count') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center gap-2">
                    <input type="checkbox" name="is_active" id="is_active" value="1"
                           {{ old('is_active', $building->is_active) ? 'checked' : '' }}
                           class="accent-blue-500"/>
                    <label for="is_active" class="text-sm text-gray-600">Bâtiment actif</label>
                </div>

                <div class="flex gap-3 pt-2">
                    <a href="{{ route('admin.buildings.index') }}"
                       class="flex-1 text-center border border-gray-200 rounded-lg py-2.5 text-sm text-gray-500 hover:bg-gray-50">
                        Annuler
                    </a>
                    <button type="submit"
                            class="flex-1 bg-yellow-400 hover:bg-yellow-500 text-white font-semibold py-2.5 rounded-lg text-sm">
                        Mettre à jour
                    </button>
                </div>

            </form>
        </div>

    </div>

</body>
</html>
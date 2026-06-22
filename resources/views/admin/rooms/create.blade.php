<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Nouvelle Salle</title>
     @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 min-h-screen p-8">

    <div class="max-w-lg mx-auto">

        <a href="{{ route('admin.rooms.index') }}" class="text-sm text-gray-400 hover:text-gray-600 mb-6 inline-block">
            ← Retour
        </a>

        <div class="bg-white rounded-2xl shadow-sm p-8">

            <h1 class="text-xl font-bold text-gray-800 mb-6">Nouvelle salle</h1>

            <form method="POST" action="{{ route('admin.rooms.store') }}" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Nom</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                           class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-100"/>
                    @error('name') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Bâtiment</label>
                    <select name="building_id"
                            class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-100 bg-white">
                        <option value="">-- Choisir --</option>
                        @foreach ($buildings as $building)
                            <option value="{{ $building->id }}" {{ old('building_id') == $building->id ? 'selected' : '' }}>
                                {{ $building->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('building_id') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Étage</label>
                    <input type="number" name="floor" value="{{ old('floor') }}" min="0"
                           class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-100"/>
                    @error('floor') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Capacité</label>
                    <input type="number" name="capacity" value="{{ old('capacity') }}" min="1"
                           class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-100"/>
                    @error('capacity') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Équipements</label>
                    <div class="border border-gray-200 rounded-lg px-4 py-3 space-y-2">
                        @foreach ($equipements as $equipement)
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="equipements[]" value="{{ $equipement->id }}"
                                       {{ in_array($equipement->id, old('equipements', [])) ? 'checked' : '' }}
                                       class="accent-blue-500"/>
                                <span class="text-sm text-gray-600">{{ $equipement->name }}</span>
                                <span class="text-xs text-gray-400">({{ $equipement->type }})</span>
                            </label>
                        @endforeach
                    </div>
                    @error('equipements') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center gap-2">
                    <input type="checkbox" name="is_active" id="is_active" value="1" checked class="accent-blue-500"/>
                    <label for="is_active" class="text-sm text-gray-600">Salle active</label>
                </div>

                <div class="flex gap-3 pt-2">
                    <a href="{{ route('admin.rooms.index') }}"
                       class="flex-1 text-center border border-gray-200 rounded-lg py-2.5 text-sm text-gray-500 hover:bg-gray-50">
                        Annuler
                    </a>
                    <button type="submit"
                            class="flex-1 bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2.5 rounded-lg text-sm">
                        Enregistrer
                    </button>
                </div>

            </form>
        </div>

    </div>

</body>
</html>
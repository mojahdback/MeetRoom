<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Modifier Équipement</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-8">

    <div class="max-w-lg mx-auto">

        <a href="{{ route('equipements.index') }}" class="text-sm text-gray-400 hover:text-gray-600 mb-6 inline-block">
            ← Retour
        </a>

        <div class="bg-white rounded-2xl shadow-sm p-8">

            <h1 class="text-xl font-bold text-gray-800 mb-6">Modifier l'équipement</h1>

            <form method="POST" action="{{ route('equipements.update', $equipement) }}" class="space-y-4">
                @csrf
                @method('PATCH')

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Nom</label>
                    <input type="text" name="name" value="{{ old('name', $equipement->name) }}"
                           class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-100"/>
                    @error('name') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Type</label>
                    <select name="type"
                            class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-100 bg-white">
                        <option value="">-- Choisir --</option>
                        <option value="audio"   {{ old('type', $equipement->type) == 'audio'   ? 'selected' : '' }}>Audio</option>
                        <option value="video"   {{ old('type', $equipement->type) == 'video'   ? 'selected' : '' }}>Vidéo</option>
                        <option value="display" {{ old('type', $equipement->type) == 'display' ? 'selected' : '' }}>Display</option>
                        <option value="autre"   {{ old('type', $equipement->type) == 'autre'   ? 'selected' : '' }}>Autre</option>
                    </select>
                    @error('type') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Description</label>
                    <textarea name="description" rows="3"
                              class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-100 resize-none">{{ old('description', $equipement->description) }}</textarea>
                    @error('description') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex gap-3 pt-2">
                    <a href="{{ route('equipements.index') }}"
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
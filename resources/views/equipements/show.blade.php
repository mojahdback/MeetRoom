<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Détail Équipement</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-8">

    <div class="max-w-3xl mx-auto">

        <a href="{{ route('equipements.index') }}" class="text-sm text-gray-400 hover:text-gray-600 mb-6 inline-block">
            ← Retour
        </a>

        <!-- Info -->
        <div class="bg-white rounded-2xl shadow-sm p-8 mb-6">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-xl font-bold text-gray-800">{{ $equipement->name }}</h1>
                    <span class="bg-blue-100 text-blue-600 text-xs font-semibold px-2.5 py-0.5 rounded-full mt-2 inline-block">
                        {{ $equipement->type }}
                    </span>
                    <p class="text-sm text-gray-400 mt-3">{{ $equipement->description }}</p>
                </div>
                <a href="{{ route('equipements.edit', $equipement) }}"
                   class="border border-gray-200 text-gray-500 hover:bg-gray-50 text-xs font-medium px-3 py-1.5 rounded-lg">
                    Modifier
                </a>
            </div>
        </div>

        <!-- Rooms using this equipment -->
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h2 class="font-semibold text-gray-700">Salles utilisant cet équipement</h2>
            </div>
            <table class="w-full text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="text-left px-5 py-3 text-gray-500 font-semibold">Salle</th>
                        <th class="text-left px-5 py-3 text-gray-500 font-semibold">Bâtiment</th>
                        <th class="text-left px-5 py-3 text-gray-500 font-semibold">Étage</th>
                        <th class="text-left px-5 py-3 text-gray-500 font-semibold">Capacité</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse ($equipement->rooms as $room)
                    <tr class="hover:bg-gray-50">
                        <td class="px-5 py-3 font-medium text-gray-700">{{ $room->name }}</td>
                        <td class="px-5 py-3 text-gray-500">{{ $room->building->name }}</td>
                        <td class="px-5 py-3 text-gray-500">{{ $room->floor }}</td>
                        <td class="px-5 py-3 text-gray-500">{{ $room->capacity }} pers.</td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="text-center py-8 text-gray-400">Aucune salle assignée.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</body>
</html>
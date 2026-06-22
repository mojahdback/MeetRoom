<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Détail Bâtiment</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 min-h-screen p-8">

    <div class="max-w-3xl mx-auto">

        <a href="{{ route('admin.buildings.index') }}"
            class="text-sm text-gray-400 hover:text-gray-600 mb-6 inline-block">
            ← Retour
        </a>

        <!-- Info -->
        <div class="bg-white rounded-2xl shadow-sm p-8 mb-6">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-xl font-bold text-gray-800">{{ $building->name }}</h1>
                    <p class="text-sm text-gray-400 mt-1">{{ $building->address }}</p>
                    <p class="text-sm text-gray-400">{{ $building->floors_count }} étages</p>
                </div>
                <div class="flex items-center gap-2">
                    @if ($building->is_active)
                        <span
                            class="bg-green-100 text-green-600 text-xs font-semibold px-2.5 py-1 rounded-full">Actif</span>
                    @else
                        <span class="bg-red-100 text-red-500 text-xs font-semibold px-2.5 py-1 rounded-full">Inactif</span>
                    @endif
                    <a href="{{ route('admin.buildings.edit', $building) }}"
                        class="border border-gray-200 text-gray-500 hover:bg-gray-50 text-xs font-medium px-3 py-1.5 rounded-lg">
                        Modifier
                    </a>
                </div>
            </div>
        </div>

        <!-- Rooms -->
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
            <div class="flex justify-between items-center px-6 py-4 border-b border-gray-100">
                <h2 class="font-semibold text-gray-700">Salles</h2>
                <a href="{{ route('admin.rooms.create') }}" class="text-sm text-blue-500 hover:underline">+ Ajouter une
                    salle</a>
            </div>
            <table class="w-full text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="text-left px-5 py-3 text-gray-500 font-semibold">Nom</th>
                        <th class="text-left px-5 py-3 text-gray-500 font-semibold">Étage</th>
                        <th class="text-left px-5 py-3 text-gray-500 font-semibold">Capacité</th>
                        <th class="text-left px-5 py-3 text-gray-500 font-semibold">Statut</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse ($building->rooms as $room)
                        <tr class="hover:bg-gray-50">
                            <td class="px-5 py-3 font-medium text-gray-700">{{ $room->name }}</td>
                            <td class="px-5 py-3 text-gray-500">{{ $room->floor }}</td>
                            <td class="px-5 py-3 text-gray-500">{{ $room->capacity }} pers.</td>
                            <td class="px-5 py-3">
                                @if ($room->is_active)
                                    <span
                                        class="bg-green-100 text-green-600 text-xs font-semibold px-2.5 py-0.5 rounded-full">Active</span>
                                @else
                                    <span
                                        class="bg-red-100 text-red-500 text-xs font-semibold px-2.5 py-0.5 rounded-full">Inactive</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-8 text-gray-400">Aucune salle.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</body>

</html>
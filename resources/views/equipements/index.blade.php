<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Équipements</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-8">

    <div class="max-w-4xl mx-auto">

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Équipements</h1>
            <a href="{{ route('equipements.create') }}"
               class="bg-blue-500 hover:bg-blue-600 text-white text-sm font-semibold px-4 py-2 rounded-lg">
                + Ajouter
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="text-left px-5 py-3 text-gray-500 font-semibold">Nom</th>
                        <th class="text-left px-5 py-3 text-gray-500 font-semibold">Type</th>
                        <th class="text-left px-5 py-3 text-gray-500 font-semibold">Description</th>
                        <th class="text-left px-5 py-3 text-gray-500 font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse ($equipements as $equipement)
                    <tr class="hover:bg-gray-50">
                        <td class="px-5 py-3 font-medium text-gray-700">{{ $equipement->name }}</td>
                        <td class="px-5 py-3">
                            <span class="bg-blue-100 text-blue-600 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                                {{ $equipement->type }}
                            </span>
                        </td>
                        <td class="px-5 py-3 text-gray-500">{{ $equipement->description }}</td>
                        <td class="px-5 py-3 flex gap-3">
                            <a href="{{ route('equipements.show', $equipement) }}" class="text-sm text-blue-500 hover:underline">Voir</a>
                            <a href="{{ route('equipements.edit', $equipement) }}" class="text-sm text-yellow-500 hover:underline">Modifier</a>
                            <form method="POST" action="{{ route('equipements.destroy', $equipement) }}">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-sm text-red-400 hover:underline"
                                        onclick="return confirm('Supprimer cet équipement ?')">
                                    Supprimer
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="text-center py-8 text-gray-400">Aucun équipement.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</body>
</html>
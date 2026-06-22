<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Détail Salle</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 min-h-screen p-8">

    <div class="max-w-3xl mx-auto">

        <a href="{{ route('admin.rooms.index') }}" class="text-sm text-gray-400 hover:text-gray-600 mb-6 inline-block">
            ← Retour
        </a>

        <!-- Info -->
        <div class="bg-white rounded-2xl shadow-sm p-8 mb-6">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-xl font-bold text-gray-800">{{ $room->name }}</h1>
                    <p class="text-sm text-gray-400 mt-1">{{ $room->building->name }} · Étage {{ $room->floor }}</p>
                    <p class="text-sm text-gray-400">Capacité : {{ $room->capacity }} personnes</p>
                </div>
                <div class="flex items-center gap-2">
                    @if ($room->is_active)
                        <span
                            class="bg-green-100 text-green-600 text-xs font-semibold px-2.5 py-1 rounded-full">Active</span>
                    @else
                        <span class="bg-red-100 text-red-500 text-xs font-semibold px-2.5 py-1 rounded-full">Inactive</span>
                    @endif
                    <a href="{{ route('admin.rooms.edit', $room) }}"
                        class="border border-gray-200 text-gray-500 hover:bg-gray-50 text-xs font-medium px-3 py-1.5 rounded-lg">
                        Modifier
                    </a>
                </div>
            </div>
        </div>

        <!-- Equipements -->
        <div class="bg-white rounded-2xl shadow-sm p-6 mb-6">
            <h2 class="font-semibold text-gray-700 mb-4">Équipements</h2>
            @if ($room->equipements->count())
                <div class="flex flex-wrap gap-2">
                    @foreach ($room->equipements as $equipement)
                        <span class="bg-blue-100 text-blue-600 text-xs font-semibold px-3 py-1 rounded-full">
                            {{ $equipement->name }}
                        </span>
                    @endforeach
                </div>
            @else
                <p class="text-sm text-gray-400">Aucun équipement assigné.</p>
            @endif
        </div>



</body>

</html>
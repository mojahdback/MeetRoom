<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Nouvelle Réservation</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 min-h-screen">

    <!-- Navbar -->
    <nav class="bg-white border-b border-gray-200 px-6 py-3 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 rounded-lg flex items-center justify-center bg-blue-500">
                <svg width="16" height="16" fill="none" stroke="#fff" stroke-width="2.2" viewBox="0 0 24 24"
                    stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="18" height="18" rx="3" />
                    <path d="M3 9h18M9 21V9" />
                </svg>
            </div>
            <span class="font-bold text-gray-800">MeetRoom</span>
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ route('employee.reservations') }}" class="text-sm text-gray-500 hover:text-gray-800">Salles</a>
            <a href="{{ route('employee.reservations') }}" class="text-sm text-gray-500 hover:text-gray-800">Mes
                réservations</a>
        </div>
    </nav>

    <div class="max-w-2xl mx-auto px-6 py-10">

        <a href="{{ route('employee.reservations') }}"
            class="text-sm text-gray-400 hover:text-gray-600 mb-6 inline-block">
            ← Retour aux salles
        </a>

        <!-- Room summary card -->
        <div class="bg-white rounded-2xl shadow-sm p-5 mb-6 flex items-start justify-between">
            <div>
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-1">Salle sélectionnée</p>
                <h2 class="font-bold text-gray-800 text-lg">{{ $room->name }}</h2>
                <p class="text-sm text-gray-400 mt-0.5">🏢 {{ $room->building->name }} · Étage {{ $room->floor }}</p>
                <p class="text-sm text-gray-400">👥 {{ $room->capacity }} personnes max.</p>
            </div>
            @if ($room->equipements->count())
                <div class="flex flex-wrap gap-1.5 max-w-xs justify-end">
                    @foreach ($room->equipements as $eq)
                        <span
                            class="bg-blue-50 text-blue-600 text-xs font-semibold px-2.5 py-0.5 rounded-full border border-blue-100">
                            {{ $eq->name }}
                        </span>
                    @endforeach
                </div>
            @endif
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <!-- Form card -->
        <div class="bg-white rounded-2xl shadow-sm p-8">

            <h1 class="text-xl font-bold text-gray-800 mb-1">Nouvelle réservation</h1>
            <p class="text-sm text-gray-400 mb-6">Remplissez les informations du créneau souhaité</p>

            @if ($errors->any())
                <div class="mb-5 p-3 rounded-lg text-sm bg-red-50 border border-red-200 text-red-500">
                    <ul class="space-y-1 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('employee.reservations.store', $room->id) }}" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Date</label>
                    <input type="date" name="date" value="{{ old('date') }}"
                        class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-100" />
                    @error('date') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Date début -->
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Date et heure de début</label>
                    <input type="time" name="start_time" value="{{ old('start_time') }}"
                        class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-100" />
                    @error('start_time') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Date fin -->
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Date et heure de fin</label>
                    <input type="time" name="end_time" value="{{ old('end_time') }}"
                        class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-100" />
                    @error('end_time') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Notes -->
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Notes <span
                            class="text-gray-300 font-normal">(optionnel)</span></label>
                    <textarea name="notes" rows="3" placeholder="Objet de la réunion, participants..."
                        class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-100 resize-none">{{ old('notes') }}</textarea>
                    @error('notes') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Buttons -->
                <div class="flex gap-3 pt-2">
                    <a href="{{ route('employee.reservations') }}"
                        class="flex-1 text-center border border-gray-200 rounded-lg py-2.5 text-sm text-gray-500 hover:bg-gray-50">
                        Annuler
                    </a>
                    <button type="submit"
                        class="flex-1 bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2.5 rounded-lg text-sm transition">
                        Confirmer la réservation
                    </button>
                </div>

            </form>
        </div>

    </div>

</body>

</html>
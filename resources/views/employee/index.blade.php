<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Salles disponibles</title>
  <script src="https://cdn.tailwindcss.com"></script>
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
      <a href="{{ route('employee.reservations.history') }}" class="text-sm text-gray-500 hover:text-gray-800">Mes
        réservations</a>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="text-sm text-red-400 hover:text-red-600">Déconnexion</button>
      </form>
    </div>
  </nav>

  <div class="max-w-7xl mx-auto px-6 py-8 flex gap-6">

    <!-- ===== SIDEBAR ===== -->
    <aside class="w-64 flex-shrink-0">
      <div class="bg-white rounded-2xl shadow-sm p-6">

        <h2 class="font-bold text-gray-800 mb-5">Filtrer</h2>

        <form method="GET" action="{{ route('employee.reservations') }}" class="space-y-5">

          <!-- Bâtiment -->
          <div>
            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Bâtiment</label>
            <select name="building_id"
              class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-100 bg-white">
              <option value="">Tous</option>
              @foreach ($buildings as $building)
                <option value="{{ $building->id }}" {{ request('building_id') == $building->id ? 'selected' : '' }}>
                  {{ $building->name }}
                </option>
              @endforeach
            </select>
          </div>

          <!-- Date -->
          <div>
            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Date</label>
            <input type="date" name="date" value="{{ request('date') }}"
              class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-100" />
          </div>

          <!-- Heure début -->
          <div>
            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Heure début</label>
            <input type="time" name="start_time" value="{{ request('start_time') }}"
              class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-100" />
          </div>

          <!-- Heure fin -->
          <div>
            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Heure fin</label>
            <input type="time" name="end_time" value="{{ request('end_time') }}"
              class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-100" />
          </div>

          <!-- Capacité -->
          <div>
            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Capacité min.</label>
            <input type="number" name="capacity" min="1" value="{{ request('capacity') }}" placeholder="ex : 8"
              class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-100" />
          </div>

          <!-- Équipements -->
          <div>
            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Équipements</label>
            <div class="space-y-2">
              @foreach ($equipements as $equipement)
                <label class="flex items-center gap-2 cursor-pointer">
                  <input type="checkbox" name="equipements[]" value="{{ $equipement->id }}" {{ in_array($equipement->id, request('equipements', [])) ? 'checked' : '' }} class="accent-blue-500" />
                  <span class="text-sm text-gray-600">{{ $equipement->name }}</span>
                </label>
              @endforeach
            </div>
          </div>

          <button type="submit"
            class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2.5 rounded-lg text-sm transition">
            Rechercher
          </button>

          <a href="{{ route('employee.reservations') }}"
            class="block text-center text-sm text-gray-400 hover:text-gray-600">
            Réinitialiser
          </a>

        </form>
      </div>
    </aside>

    <!-- ===== MAIN ===== -->
    <main class="flex-1">

      <div class="flex items-center justify-between mb-6">
        <div>
          <h1 class="text-xl font-bold text-gray-800">Salles disponibles</h1>
          <p class="text-sm text-gray-400">{{ $rooms->count() }} salle(s) trouvée(s)</p>
        </div>
      </div>

      @if ($rooms->count())
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
          @foreach ($rooms as $room)
            <div class="bg-white rounded-2xl shadow-sm p-5 flex flex-col gap-4 hover:shadow-md transition">

              <!-- Name + building -->
              <div>
                <h3 class="font-bold text-gray-800 text-base">{{ $room->name }}</h3>
                <p class="text-sm text-gray-400 mt-0.5">
                  🏢 {{ $room->building->name }} · Étage {{ $room->floor }}
                </p>
              </div>

              <!-- Capacité -->
              <div class="flex items-center gap-2 text-sm text-gray-500">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                  stroke-linecap="round" stroke-linejoin="round">
                  <circle cx="12" cy="8" r="4" />
                  <path d="M20 21a8 8 0 1 0-16 0" />
                </svg>
                {{ $room->capacity }} personnes max.
              </div>

              <!-- Équipements -->
              @if ($room->equipements->count())
                <div class="flex flex-wrap gap-1.5">
                  @foreach ($room->equipements as $eq)
                    <span
                      class="bg-blue-50 text-blue-600 text-xs font-semibold px-2.5 py-0.5 rounded-full border border-blue-100">
                      {{ $eq->name }}
                    </span>
                  @endforeach
                </div>
              @else
                <p class="text-xs text-gray-300">Aucun équipement</p>
              @endif

              <!-- Bouton réserver -->
              <form action="{{ route('employee.reservations.create', $room->id) }}" method="get"
                class="mt-auto block text-center bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-lg text-sm transition">
                <button>Réserver</button>
              </form>

            </div>
          @endforeach
        </div>

      @else
        <div class="bg-white rounded-2xl shadow-sm flex flex-col items-center justify-center py-20 text-center">
          <svg width="48" height="48" fill="none" stroke="#CBD5E1" stroke-width="1.5" viewBox="0 0 24 24"
            stroke-linecap="round" stroke-linejoin="round" class="mb-4">
            <rect x="3" y="3" width="18" height="18" rx="3" />
            <path d="M3 9h18M9 21V9" />
          </svg>
          <p class="text-gray-400 font-medium">Aucune salle disponible</p>
          <p class="text-sm text-gray-300 mt-1">Essayez d'autres critères de recherche.</p>
        </div>
      @endif

    </main>

  </div>

</body>

</html>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Toutes les réservations</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- Navbar -->
    <nav class="bg-white border-b border-gray-200 px-6 py-3 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 rounded-lg flex items-center justify-center bg-blue-500">
                <svg width="16" height="16" fill="none" stroke="#fff" stroke-width="2.2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="18" height="18" rx="3"/><path d="M3 9h18M9 21V9"/>
                </svg>
            </div>
            <span class="font-bold text-gray-800">MeetRoom</span>
            <span class="text-xs text-gray-400 ml-1">Admin</span>
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ route('buildings.index') }}" class="text-sm text-gray-500 hover:text-gray-800">Bâtiments</a>
            <a href="{{ route('rooms.index') }}"     class="text-sm text-gray-500 hover:text-gray-800">Salles</a>
            <a href="{{ route('equipements.index') }}" class="text-sm text-gray-500 hover:text-gray-800">Équipements</a>
            <a href="{{ route('admin.reservations.index') }}" class="text-sm text-blue-500 font-semibold">Réservations</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="text-sm text-red-400 hover:text-red-600">Déconnexion</button>
            </form>
        </div>
    </nav>

    <div class="max-w-6xl mx-auto px-6 py-10">

        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Toutes les réservations</h1>
            <p class="text-sm text-gray-400 mt-1">Gérez et supervisez toutes les réservations</p>
        </div>

        <!-- Tabs -->
        <div class="flex gap-2 mb-6">
            <button onclick="showTab('all')"       id="tab-all"
                    class="px-4 py-2 rounded-lg text-sm font-semibold bg-blue-500 text-white transition">
                Toutes
                <span class="ml-1 bg-white text-blue-500 text-xs font-bold px-1.5 py-0.5 rounded-full">{{ $reservations->count() }}</span>
            </button>
            <button onclick="showTab('pending')"   id="tab-pending"
                    class="px-4 py-2 rounded-lg text-sm font-semibold bg-white text-gray-500 hover:bg-gray-50 transition">
                En attente
                <span class="ml-1 bg-yellow-100 text-yellow-600 text-xs font-bold px-1.5 py-0.5 rounded-full">{{ $reservations->where('status','pending')->count() }}</span>
            </button>
            <button onclick="showTab('confirmed')" id="tab-confirmed"
                    class="px-4 py-2 rounded-lg text-sm font-semibold bg-white text-gray-500 hover:bg-gray-50 transition">
                Confirmées
                <span class="ml-1 bg-green-100 text-green-600 text-xs font-bold px-1.5 py-0.5 rounded-full">{{ $reservations->where('status','confirmed')->count() }}</span>
            </button>
            <button onclick="showTab('cancelled')" id="tab-cancelled"
                    class="px-4 py-2 rounded-lg text-sm font-semibold bg-white text-gray-500 hover:bg-gray-50 transition">
                Annulées
                <span class="ml-1 bg-red-100 text-red-400 text-xs font-bold px-1.5 py-0.5 rounded-full">{{ $reservations->where('status','cancelled')->count() }}</span>
            </button>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="text-left px-5 py-3 text-gray-500 font-semibold">Employé</th>
                        <th class="text-left px-5 py-3 text-gray-500 font-semibold">Salle</th>
                        <th class="text-left px-5 py-3 text-gray-500 font-semibold">Bâtiment</th>
                        <th class="text-left px-5 py-3 text-gray-500 font-semibold">Début</th>
                        <th class="text-left px-5 py-3 text-gray-500 font-semibold">Fin</th>
                        <th class="text-left px-5 py-3 text-gray-500 font-semibold">Statut</th>
                        <th class="text-left px-5 py-3 text-gray-500 font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50" id="tbody">
                    @forelse ($reservations as $reservation)
                    <tr class="hover:bg-gray-50 transition row-all row-{{ $reservation->status }}">
                        <td class="px-5 py-3 font-medium text-gray-700">{{ $reservation->user->name }}</td>
                        <td class="px-5 py-3 text-gray-600">{{ $reservation->room->name }}</td>
                        <td class="px-5 py-3 text-gray-500">{{ $reservation->room->building->name }}</td>
                        <td class="px-5 py-3 text-gray-500">{{ \Carbon\Carbon::parse($reservation->start_datetime)->format('d/m/Y H:i') }}</td>
                        <td class="px-5 py-3 text-gray-500">{{ \Carbon\Carbon::parse($reservation->end_datetime)->format('d/m/Y H:i') }}</td>
                        <td class="px-5 py-3">
                            @if ($reservation->status === 'pending')
                                <span class="bg-yellow-100 text-yellow-600 text-xs font-semibold px-2.5 py-0.5 rounded-full">En attente</span>
                            @elseif ($reservation->status === 'confirmed')
                                <span class="bg-green-100 text-green-600 text-xs font-semibold px-2.5 py-0.5 rounded-full">Confirmée</span>
                            @else
                                <span class="bg-red-100 text-red-400 text-xs font-semibold px-2.5 py-0.5 rounded-full">Annulée</span>
                            @endif
                        </td>
                        <td class="px-5 py-3">
                            <div class="flex gap-2">
                                @if ($reservation->status === 'pending')
                                <form method="POST" action="{{ route('admin.reservations.confirm', $reservation) }}">
                                    @csrf @method('PATCH')
                                    <button type="submit"
                                            class="text-xs font-semibold text-green-600 border border-green-200 hover:bg-green-50 px-3 py-1.5 rounded-lg transition">
                                        Confirmer
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('admin.reservations.cancel', $reservation) }}">
                                    @csrf @method('PATCH')
                                    <button type="submit"
                                            onclick="return confirm('Annuler cette réservation ?')"
                                            class="text-xs font-semibold text-red-400 border border-red-200 hover:bg-red-50 px-3 py-1.5 rounded-lg transition">
                                        Annuler
                                    </button>
                                </form>
                                 @else
                                <span class="bg-white-100 text-gray-400 text-xs font-semibold px-2.5 py-0.5 rounded-full">No Action</span>
                                 @endif

                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center py-10 text-gray-400">Aucune réservation.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

<script>
    function showTab(tab) {
        const tabs = ['all','pending','confirmed','cancelled'];
        const colors = { all:'bg-blue-500', pending:'bg-yellow-400', confirmed:'bg-green-500', cancelled:'bg-red-400' };

        tabs.forEach(t => {
            const btn = document.getElementById('tab-' + t);
            btn.classList.remove('bg-blue-500','bg-yellow-400','bg-green-500','bg-red-400','text-white');
            btn.classList.add('bg-white','text-gray-500');
        });

        const active = document.getElementById('tab-' + tab);
        active.classList.remove('bg-white','text-gray-500');
        active.classList.add(colors[tab], 'text-white');

        document.querySelectorAll('tbody tr').forEach(row => {
            if (tab === 'all') {
                row.classList.remove('hidden');
            } else {
                row.classList.toggle('hidden', !row.classList.contains('row-' + tab));
            }
        });
    }
</script>

</body>
</html>
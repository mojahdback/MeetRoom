<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Mes Réservations</title>
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
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ route('employee.reservations') }}" class="text-sm text-gray-500 hover:text-gray-800">Salles</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="text-sm text-red-400 hover:text-red-600">Déconnexion</button>
            </form>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto px-6 py-10">

        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Mes réservations</h1>
            <p class="text-sm text-gray-400 mt-1">Historique complet de vos réservations</p>
        </div>

        <!-- ===== TABS ===== -->
        <div class="flex gap-2 mb-6">
            <button onclick="showTab('pending')"   id="tab-pending"
                    class="tab-btn px-4 py-2 rounded-lg text-sm font-semibold transition bg-yellow-400 text-white">
                En attente
                <span class="ml-1 bg-white text-yellow-500 text-xs font-bold px-1.5 py-0.5 rounded-full">
                    {{ $pending->count() }}
                </span>
            </button>
            <button onclick="showTab('confirmed')" id="tab-confirmed"
                    class="tab-btn px-4 py-2 rounded-lg text-sm font-semibold transition bg-white text-gray-500 hover:bg-gray-50">
                Confirmées
                <span class="ml-1 bg-green-100 text-green-600 text-xs font-bold px-1.5 py-0.5 rounded-full">
                    {{ $confirmed->count() }}
                </span>
            </button>
            <button onclick="showTab('cancelled')" id="tab-cancelled"
                    class="tab-btn px-4 py-2 rounded-lg text-sm font-semibold transition bg-white text-gray-500 hover:bg-gray-50">
                Annulées
                <span class="ml-1 bg-red-100 text-red-400 text-xs font-bold px-1.5 py-0.5 rounded-full">
                    {{ $cancelled->count() }}
                </span>
            </button>
        </div>

        <!-- ===== PENDING ===== -->
        <div id="panel-pending">
            @forelse ($pending as $reservation)
            <div class="bg-white rounded-2xl shadow-sm p-5 mb-4 flex items-start justify-between gap-4">
                <div class="flex-1">
                    <div class="flex items-center gap-2 mb-1">
                        <h3 class="font-bold text-gray-800">{{ $reservation->room->name }}</h3>
                        <span class="bg-yellow-100 text-yellow-600 text-xs font-semibold px-2.5 py-0.5 rounded-full">En attente</span>
                    </div>
                    <p class="text-sm text-gray-400">🏢 {{ $reservation->room->building->name }} · Étage {{ $reservation->room->floor }}</p>
                    <div class="flex gap-4 mt-2 text-sm text-gray-500">
                        <span>📅 {{ \Carbon\Carbon::parse($reservation->start_datetime)->format('d/m/Y H:i') }}</span>
                        <span>→</span>
                        <span>{{ \Carbon\Carbon::parse($reservation->end_datetime)->format('d/m/Y H:i') }}</span>
                    </div>
                    @if ($reservation->notes)
                        <p class="text-sm text-gray-400 mt-1 italic">{{ $reservation->notes }}</p>
                    @endif
                </div>
                <!-- Cancel button -->
                <form method="POST" action="{{ route('employee.reservation.cancel', $reservation->id) }}">
                    @csrf @method('PATCH')
                    <button type="submit"
                            onclick="return confirm('Annuler cette réservation ?')"
                            class="text-sm text-red-400 hover:text-red-600 border border-red-200 hover:border-red-400 px-3 py-1.5 rounded-lg transition whitespace-nowrap">
                        Annuler
                    </button>
                </form>
            </div>
            @empty
            <div class="bg-white rounded-2xl shadow-sm flex flex-col items-center justify-center py-16 text-center">
                <p class="text-gray-400 font-medium">Aucune réservation en attente</p>
            </div>
            @endforelse
        </div>

        <!-- ===== CONFIRMED ===== -->
        <div id="panel-confirmed" class="hidden">
            @forelse ($confirmed as $reservation)
            <div class="bg-white rounded-2xl shadow-sm p-5 mb-4 flex items-start justify-between gap-4">
                <div class="flex-1">
                    <div class="flex items-center gap-2 mb-1">
                        <h3 class="font-bold text-gray-800">{{ $reservation->room->name }}</h3>
                        <span class="bg-green-100 text-green-600 text-xs font-semibold px-2.5 py-0.5 rounded-full">Confirmée</span>
                    </div>
                    <p class="text-sm text-gray-400">🏢 {{ $reservation->room->building->name }} · Étage {{ $reservation->room->floor }}</p>
                    <div class="flex gap-4 mt-2 text-sm text-gray-500">
                        <span>📅 {{ \Carbon\Carbon::parse($reservation->start_datetime)->format('d/m/Y H:i') }}</span>
                        <span>→</span>
                        <span>{{ \Carbon\Carbon::parse($reservation->end_datetime)->format('d/m/Y H:i') }}</span>
                    </div>
                    @if ($reservation->notes)
                        <p class="text-sm text-gray-400 mt-1 italic">{{ $reservation->notes }}</p>
                    @endif
                </div>
                <!-- Cancel button -->
                <form method="POST" action="{{ route('employee.reservation.cancel', $reservation->id) }}">
                    @csrf @method('PATCH')
                    <button type="submit"
                            onclick="return confirm('Annuler cette réservation ?')"
                            class="text-sm text-red-400 hover:text-red-600 border border-red-200 hover:border-red-400 px-3 py-1.5 rounded-lg transition whitespace-nowrap">
                        Annuler
                    </button>
                </form>
            </div>
            @empty
            <div class="bg-white rounded-2xl shadow-sm flex flex-col items-center justify-center py-16 text-center">
                <p class="text-gray-400 font-medium">Aucune réservation confirmée</p>
            </div>
            @endforelse
        </div>

        <!-- ===== CANCELLED ===== -->
        <div id="panel-cancelled" class="hidden">
            @forelse ($cancelled as $reservation)
            <div class="bg-white rounded-2xl shadow-sm p-5 mb-4 opacity-60">
                <div class="flex items-center gap-2 mb-1">
                    <h3 class="font-bold text-gray-800">{{ $reservation->room->name }}</h3>
                    <span class="bg-red-100 text-red-400 text-xs font-semibold px-2.5 py-0.5 rounded-full">Annulée</span>
                </div>
                <p class="text-sm text-gray-400">🏢 {{ $reservation->room->building->name }} · Étage {{ $reservation->room->floor }}</p>
                <div class="flex gap-4 mt-2 text-sm text-gray-500">
                    <span>📅 {{ \Carbon\Carbon::parse($reservation->start_datetime)->format('d/m/Y H:i') }}</span>
                    <span>→</span>
                    <span>{{ \Carbon\Carbon::parse($reservation->end_datetime)->format('d/m/Y H:i') }}</span>
                </div>
                @if ($reservation->notes)
                    <p class="text-sm text-gray-400 mt-1 italic">{{ $reservation->notes }}</p>
                @endif
            </div>
            @empty
            <div class="bg-white rounded-2xl shadow-sm flex flex-col items-center justify-center py-16 text-center">
                <p class="text-gray-400 font-medium">Aucune réservation annulée</p>
            </div>
            @endforelse
        </div>

    </div>

<script>
    function showTab(tab) {
        // hide all panels
        ['pending','confirmed','cancelled'].forEach(t => {
            document.getElementById('panel-' + t).classList.add('hidden');
            document.getElementById('tab-' + t).classList.remove('text-white');
            document.getElementById('tab-' + t).classList.add('bg-white','text-gray-500');
        });

        // active colors per tab
        const colors = {
            pending:   'bg-yellow-400',
            confirmed: 'bg-green-500',
            cancelled: 'bg-red-400',
        };

        document.getElementById('panel-' + tab).classList.remove('hidden');
        const btn = document.getElementById('tab-' + tab);
        btn.classList.remove('bg-white','text-gray-500');
        btn.classList.add(colors[tab], 'text-white');
    }
</script>

</body>
</html>
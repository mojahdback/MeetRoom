<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Équipements</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 min-h-screen">

    <div class="flex">

        <!-- ===== SIDEBAR ===== -->
        <aside class="w-60 bg-white border-r border-gray-200 flex flex-col h-screen sticky top-0">

            <!-- Logo -->
            <div class="flex items-center gap-2 px-6 py-5 border-b border-gray-100">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center bg-blue-500">
                    <svg width="16" height="16" fill="none" stroke="#fff" stroke-width="2.2" viewBox="0 0 24 24"
                        stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="3" width="18" height="18" rx="3" />
                        <path d="M3 9h18M9 21V9" />
                    </svg>
                </div>
                <span class="font-bold text-gray-800">MeetRoom</span>
            </div>

            <!-- Nav links -->
            <nav class="flex-1 px-3 py-4 space-y-1">

                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-600' : 'text-gray-500 hover:bg-gray-50' }}">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                        stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="3" width="7" height="9" />
                        <rect x="14" y="3" width="7" height="5" />
                        <rect x="14" y="12" width="7" height="9" />
                        <rect x="3" y="16" width="7" height="5" />
                    </svg>
                    Tableau de bord
                </a>

                <a href="{{ route('admin.buildings.index') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('admin.buildings.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-500 hover:bg-gray-50' }}">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                        <polyline points="9 22 9 12 15 12 15 22" />
                    </svg>
                    Bâtiments
                </a>

                <a href="{{ route('admin.rooms.index') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('admin.rooms.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-500 hover:bg-gray-50' }}">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                        stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="3" width="18" height="18" rx="3" />
                        <path d="M3 9h18M9 21V9" />
                    </svg>
                    Salles
                </a>

                <a href="{{ route('admin.equipements.index') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('admin.equipements.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-500 hover:bg-gray-50' }}">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                        stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="3" width="20" height="14" rx="2" />
                        <path d="M8 21h8M12 17v4" />
                    </svg>
                    Équipements
                </a>

                <a href="{{ route('admin.reservations.index') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('admin.reservations.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-500 hover:bg-gray-50' }}">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                        stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="18" rx="2" />
                        <path d="M16 2v4M8 2v4M3 10h18" />
                    </svg>
                    Réservations
                </a>

            </nav>

            <!-- User + logout -->
            <div class="px-3 py-4 border-t border-gray-100">
                <div class="flex items-center gap-3 px-3 py-2 mb-2">
                    <div
                        class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-sm font-bold">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-700 truncate">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-400 truncate">{{ auth()->user()->email }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-red-400 hover:bg-red-50 transition">
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                            <polyline points="16 17 21 12 16 7" />
                            <line x1="21" y1="12" x2="9" y2="12" />
                        </svg>
                        Déconnexion
                    </button>
                </form>
            </div>

        </aside>
        <main class="flex-1 p-8">

            <div class="max-w-4xl mx-auto">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold text-gray-800">Équipements</h1>
                    <a href="{{ route('admin.equipements.create') }}"
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
                                        <span
                                            class="bg-blue-100 text-blue-600 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                                            {{ $equipement->type }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-3 text-gray-500">{{ $equipement->description }}</td>
                                    <td class="px-5 py-3 flex gap-3">
                                        <a href="{{ route('admin.equipements.show', $equipement) }}"
                                            class="text-sm text-blue-500 hover:underline">Voir</a>
                                        <a href="{{ route('admin.equipements.edit', $equipement) }}"
                                            class="text-sm text-yellow-500 hover:underline">Modifier</a>
                                        <form method="POST" action="{{ route('admin.equipements.destroy', $equipement) }}">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-sm text-red-400 hover:underline"
                                                onclick="return confirm('Supprimer cet équipement ?')">
                                                Supprimer
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-8 text-gray-400">Aucun équipement.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>



            </div>

        </main>
    </div>




</body>

</html>
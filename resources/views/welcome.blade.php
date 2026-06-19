<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>MeetRoom</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

  <!-- Navbar -->
  <nav class="bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between">
    <div class="flex items-center gap-2">
      <div class="w-8 h-8 rounded-lg flex items-center justify-center bg-blue-500">
        <svg width="16" height="16" fill="none" stroke="#fff" stroke-width="2.2" viewBox="0 0 24 24"
          stroke-linecap="round" stroke-linejoin="round">
          <rect x="3" y="3" width="18" height="18" rx="3" />
          <path d="M3 9h18M9 21V9" />
        </svg>
      </div>
      <span class="font-bold text-gray-800 text-lg">MeetRoom</span>
    </div>
    <div class="flex items-center gap-4">
      @if (!auth()->check())
        <a href="{{ route('login') }}" class="text-sm text-gray-500 hover:text-gray-800">Se connecter</a>
        <a href="{{ route('register') }}"
          class="bg-blue-500 hover:bg-blue-600 text-white text-sm font-semibold px-4 py-2 rounded-lg">
          S'inscrire
        </a>
      @else
        @if (auth()->user()->role === 'admin')

          <a href="{{ route('admin.dashboard') }}"
            class="bg-blue-500 hover:bg-blue-600 text-white text-sm font-semibold px-4 py-2 rounded-lg">
            Dashboard
          </a>
        @else
          <a href="{{ route('employee.reservations') }}"
            class="bg-blue-500 hover:bg-blue-600 text-white text-sm font-semibold px-4 py-2 rounded-lg">
            Reserver Room
          </a>


        @endif
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit"
            class="w-full px-3 py-2.5 rounded-lg text-sm font-medium text-red-400 hover:bg-red-50 transition">
            Déconnexion
          </button>
        </form>

      @endif

    </div>
  </nav>

  <!-- Hero -->
  <section class="max-w-5xl mx-auto px-6 py-20 text-center">
    <span class="bg-blue-100 text-blue-600 text-xs font-semibold px-3 py-1 rounded-full">
      Nexora Solutions · Casablanca
    </span>
    <h1 class="text-4xl font-bold text-gray-800 mt-5 leading-tight">
      Réservez vos salles,<br />
      <span class="text-blue-500">sans conflits</span>, sans attente.
    </h1>
    <p class="text-gray-500 mt-5 max-w-xl mx-auto">
      MeetRoom met fin aux doubles réservations et aux échanges d'emails interminables.
      Trouvez, réservez et gérez vos espaces de réunion en quelques clics.
    </p>
    <div class="flex items-center justify-center gap-3 mt-8">
      <a href="{{ route('register') }}"
        class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-3 rounded-lg text-sm">
        Commencer maintenant
      </a>
      <a href="#features"
        class="border border-gray-200 text-gray-600 hover:bg-gray-50 font-semibold px-6 py-3 rounded-lg text-sm">
        En savoir plus
      </a>
    </div>
  </section>

  <!-- Stats -->
  <section class="max-w-5xl mx-auto px-6 py-10">
    <div class="bg-white rounded-2xl shadow-sm grid grid-cols-2 md:grid-cols-4 divide-x divide-gray-100">
      <div class="text-center py-6">
        <p class="text-3xl font-bold text-blue-500">2</p>
        <p class="text-sm text-gray-400 mt-1">Bâtiments</p>
      </div>
      <div class="text-center py-6">
        <p class="text-3xl font-bold text-blue-500">20+</p>
        <p class="text-sm text-gray-400 mt-1">Salles</p>
      </div>
      <div class="text-center py-6">
        <p class="text-3xl font-bold text-blue-500">0</p>
        <p class="text-sm text-gray-400 mt-1">Conflits</p>
      </div>
      <div class="text-center py-6">
        <p class="text-3xl font-bold text-blue-500">100%</p>
        <p class="text-sm text-gray-400 mt-1">Vérifié serveur</p>
      </div>
    </div>
  </section>

  <!-- Features -->
  <section id="features" class="max-w-5xl mx-auto px-6 py-16">
    <h2 class="text-2xl font-bold text-gray-800 text-center mb-2">Fonctionnalités</h2>
    <p class="text-gray-400 text-center mb-10">Tout ce dont vous avez besoin, rien de superflu.</p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

      <div class="bg-white rounded-2xl shadow-sm p-6">
        <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center mb-4">
          <svg width="18" height="18" fill="none" stroke="#3b82f6" stroke-width="2" viewBox="0 0 24 24"
            stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8" />
            <path d="m21 21-4.35-4.35" />
          </svg>
        </div>
        <h3 class="font-semibold text-gray-800 mb-2">Recherche avancée</h3>
        <p class="text-sm text-gray-500">Filtrez par bâtiment, créneau, capacité et équipements requis.</p>
      </div>

      <div class="bg-white rounded-2xl shadow-sm p-6">
        <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center mb-4">
          <svg width="18" height="18" fill="none" stroke="#3b82f6" stroke-width="2" viewBox="0 0 24 24"
            stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="4" width="18" height="18" rx="2" />
            <path d="M16 2v4M8 2v4M3 10h18" />
          </svg>
        </div>
        <h3 class="font-semibold text-gray-800 mb-2">Réservation instantanée</h3>
        <p class="text-sm text-gray-500">Réservez en quelques secondes avec vérification automatique des conflits.</p>
      </div>

      <div class="bg-white rounded-2xl shadow-sm p-6">
        <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center mb-4">
          <svg width="18" height="18" fill="none" stroke="#3b82f6" stroke-width="2" viewBox="0 0 24 24"
            stroke-linecap="round" stroke-linejoin="round">
            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
            <polyline points="9 22 9 12 15 12 15 22" />
          </svg>
        </div>
        <h3 class="font-semibold text-gray-800 mb-2">Gestion des bâtiments</h3>
        <p class="text-sm text-gray-500">Désactivez un bâtiment entier et bloquez toutes ses salles en un clic.</p>
      </div>

      <div class="bg-white rounded-2xl shadow-sm p-6">
        <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center mb-4">
          <svg width="18" height="18" fill="none" stroke="#3b82f6" stroke-width="2" viewBox="0 0 24 24"
            stroke-linecap="round" stroke-linejoin="round">
            <rect x="2" y="3" width="20" height="14" rx="2" />
            <path d="M8 21h8M12 17v4" />
          </svg>
        </div>
        <h3 class="font-semibold text-gray-800 mb-2">Équipements détaillés</h3>
        <p class="text-sm text-gray-500">Projecteur, webcam, tableau interactif — visibles pour chaque salle.</p>
      </div>

      <div class="bg-white rounded-2xl shadow-sm p-6">
        <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center mb-4">
          <svg width="18" height="18" fill="none" stroke="#3b82f6" stroke-width="2" viewBox="0 0 24 24"
            stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
          </svg>
        </div>
        <h3 class="font-semibold text-gray-800 mb-2">Anti-chevauchement</h3>
        <p class="text-sm text-gray-500">Impossible de réserver une salle déjà occupée, vérifié côté serveur.</p>
      </div>

      <div class="bg-white rounded-2xl shadow-sm p-6">
        <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center mb-4">
          <svg width="18" height="18" fill="none" stroke="#3b82f6" stroke-width="2" viewBox="0 0 24 24"
            stroke-linecap="round" stroke-linejoin="round">
            <line x1="18" y1="20" x2="18" y2="10" />
            <line x1="12" y1="20" x2="12" y2="4" />
            <line x1="6" y1="20" x2="6" y2="14" />
          </svg>
        </div>
        <h3 class="font-semibold text-gray-800 mb-2">Tableau de bord</h3>
        <p class="text-sm text-gray-500">Visualisez le taux d'occupation par bâtiment et par salle.</p>
      </div>

    </div>
  </section>

  <!-- CTA -->
  <section class="max-w-3xl mx-auto px-6 py-16 text-center">
    <div class="bg-white rounded-2xl shadow-sm p-10">
      <h2 class="text-2xl font-bold text-gray-800 mb-3">Prêt à commencer ?</h2>
      <p class="text-gray-500 mb-6">Rejoignez MeetRoom et simplifiez la gestion de vos espaces de travail.</p>
      <div class="flex items-center justify-center gap-3">
        <a href="{{ route('register') }}"
          class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-3 rounded-lg text-sm">
          Créer un compte
        </a>
        <a href="{{ route('login') }}"
          class="border border-gray-200 text-gray-600 hover:bg-gray-50 font-semibold px-6 py-3 rounded-lg text-sm">
          Se connecter
        </a>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="border-t border-gray-200 py-6">
    <p class="text-center text-sm text-gray-400">© 2025 Nexora Solutions · Casablanca</p>
  </footer>

</body>

</html>
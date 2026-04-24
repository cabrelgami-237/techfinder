<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechFinder - Gestion des Compétences</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .navbar-brand {
            font-weight: bold;
        }
        .nav-link.active {
            color: #ffc107 !important;
            font-weight: bold;
            background-color: rgba(255,193,7,0.1);
        }
        body {
            background-color: #f8f9fa;
        }
        .bg-gradient-primary {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
        }
    </style>
</head>
<body>

<!-- BARRE DE NAVIGATION -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow">
    <div class="container">
        <a class="navbar-brand text-warning fw-bold fs-3" href="{{ url('/') }}">
            TechFinder
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                        🏠 Accueil
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('competences*') ? 'active' : '' }}" href="{{ url('/competences') }}">
                        🛠 Compétences
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('utilisateurs*') ? 'active' : '' }}" href="{{ url('/utilisateurs') }}">
                        👥 Utilisateurs
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">🔧 Interventions</a>
                </li>
            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Rechercher...">
                <button class="btn btn-warning" type="submit">🔍 OK</button>
            </form>
        </div>
    </div>
</nav>
<!-- CONTENU PRINCIPAL -->
@yield('content')

<!-- TOAST NOTIFICATION -->
@if(session('success') || session('toast'))
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999">
    <div class="toast show" role="alert">
        <div class="toast-header bg-success text-white">
            <strong class="me-auto">✅ Succès</strong>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
        </div>
        <div class="toast-body">
            {{ session('success') ?? session('toast') }}
        </div>
    </div>
</div>
<script>
    setTimeout(() => {
        const toast = document.querySelector('.toast');
        if(toast) {
            toast.classList.remove('show');
            setTimeout(() => toast.remove(), 300);
        }
    }, 3000);
</script>
@endif

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

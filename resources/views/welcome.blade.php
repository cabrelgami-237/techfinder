@extends('template')

@section('content')
<div class="container">
    <!-- Bannière principale -->
    <div class="card shadow-lg border-0 overflow-hidden">
        <div class="card-body p-0">
            <div class="bg-gradient-primary text-white p-5" style="background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h1 class="display-3 fw-bold mb-3">Bienvenue sur <span class="text-warning">TechFinder</span></h1>
                        <p class="lead mb-4">La plateforme intelligente de gestion des compétences techniques</p>
                        <div class="d-flex gap-3">
                            <a href="{{ route('competences.index') }}" class="btn btn-warning btn-lg px-4">
                                🚀 Commencer maintenant
                            </a>
                            <a href="#" class="btn btn-outline-light btn-lg px-4">
                                📖 En savoir plus
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 text-center d-none d-md-block">
                        <div class="fs-1">🛠️</div>
                        <div class="mt-2 text-warning fs-4">TechFinder</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistiques -->
    <div class="row mt-5 g-4">
        <div class="col-md-3">
            <div class="card shadow-sm border-0 text-center">
                <div class="card-body">
                    <div class="display-4 text-warning">📊</div>
                    <h3 class="mt-2">Gestion simple</h3>
                    <p class="text-muted">Interface intuitive et facile à utiliser</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 text-center">
                <div class="card-body">
                    <div class="display-4 text-warning">⚡</div>
                    <h3 class="mt-2">Rapide</h3>
                    <p class="text-muted">Recherche et filtrage en temps réel</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 text-center">
                <div class="card-body">
                    <div class="display-4 text-warning">🔒</div>
                    <h3 class="mt-2">Sécurisé</h3>
                    <p class="text-muted">Données protégées et confidentielles</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 text-center">
                <div class="card-body">
                    <div class="display-4 text-warning">📱</div>
                    <h3 class="mt-2">Responsive</h3>
                    <p class="text-muted">Accessible sur tous les appareils</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Fonctionnalités -->
    <div class="row mt-5 g-4">
        <div class="col-md-12">
            <h2 class="text-center mb-4 fw-bold">Fonctionnalités principales</h2>
        </div>
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-warning">🛠️ Gestion des compétences</h5>
                    <p class="card-text">Ajoutez, modifiez et supprimez facilement les compétences techniques.</p>
                    <a href="{{ route('competences.index') }}" class="btn btn-outline-warning btn-sm">Accéder →</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-warning">👥 Gestion des utilisateurs</h5>
                    <p class="card-text">Gérez les profils utilisateurs et leurs compétences associées.</p>
                    <a href="#" class="btn btn-outline-warning btn-sm">Accéder →</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-warning">📋 Interventions</h5>
                    <p class="card-text">Suivez et planifiez les interventions techniques.</p>
                    <a href="#" class="btn btn-outline-warning btn-sm">Accéder →</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Dernières compétences ajoutées -->
    <div class="card shadow-sm mt-5">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">📋 Dernières compétences ajoutées</h5>
        </div>
        <div class="card-body">
            @php
                $latestCompetences = \App\Models\Competence::latest()->take(5)->get();
            @endphp
            @if($latestCompetences->count() > 0)
                <ul class="list-group list-group-flush">
                    @foreach($latestCompetences as $comp)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $comp->label_comp }}</strong>
                                <br>
                                <small class="text-muted">{{ $comp->description_comp ?? 'Pas de description' }}</small>
                            </div>
                            <a href="{{ route('competences.index') }}" class="btn btn-sm btn-outline-warning">Voir</a>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-muted text-center my-3">Aucune compétence enregistrée pour le moment.</p>
                <div class="text-center">
                    <a href="{{ route('competences.index') }}" class="btn btn-warning">➕ Ajouter une compétence</a>
                </div>
            @endif
        </div>
    </div>

    <!-- Footer -->
    <footer class="mt-5 py-4 border-top">
        <div class="row">
            <div class="col-md-6 text-center text-md-start">
                <p class="mb-0 text-muted">&copy; 2026 TechFinder - Tous droits réservés</p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <p class="mb-0 text-muted">Version 1.0</p>
            </div>
        </div>
    </footer>
</div>
@endsection

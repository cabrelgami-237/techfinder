@extends('template')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-dark text-white">
        <h3 class="mb-0">👥 Gestion des Utilisateurs</h3>
    </div>
    <div class="card-body">

        <!-- Formulaire d'ajout -->
        <div class="card mb-4">
            <div class="card-header bg-light">
                <h5 class="mb-0">➕ Ajouter un utilisateur</h5>
            </div>
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(isset($utilisateur))
                    <form action="{{ route('utilisateurs.update', $utilisateur->code_user) }}" method="POST">
                    @csrf
                    @method('PUT')
                @else
                    <form action="{{ route('utilisateurs.store') }}" method="POST">
                    @csrf
                @endif

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Nom <span class="text-danger">*</span></label>
                            <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror" value="{{ old('nom', $utilisateur->nom ?? '') }}" placeholder="Dupont">
                            @error('nom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Prénom <span class="text-danger">*</span></label>
                            <input type="text" name="prenom" class="form-control @error('prenom') is-invalid @enderror" value="{{ old('prenom', $utilisateur->prenom ?? '') }}" placeholder="Jean">
                            @error('prenom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $utilisateur->email ?? '') }}" placeholder="jean.dupont@email.com">
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Téléphone</label>
                            <input type="text" name="telephone" class="form-control @error('telephone') is-invalid @enderror" value="{{ old('telephone', $utilisateur->telephone ?? '') }}" placeholder="+225 07 XX XX XX XX">
                            @error('telephone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Rôle <span class="text-danger">*</span></label>
                            <select name="role" class="form-select @error('role') is-invalid @enderror">
                                <option value="">Sélectionner un rôle</option>
                                <option value="client" {{ old('role', $utilisateur->role ?? '') == 'client' ? 'selected' : '' }}>👤 Client</option>
                                <option value="technicien" {{ old('role', $utilisateur->role ?? '') == 'technicien' ? 'selected' : '' }}>🔧 Technicien</option>
                                <option value="administrateur" {{ old('role', $utilisateur->role ?? '') == 'administrateur' ? 'selected' : '' }}>👑 Administrateur</option>
                            </select>
                            @error('role')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Mot de passe <span class="text-danger">*</span></label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Minimum 6 caractères">
                            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Confirmer le mot de passe</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Retapez le mot de passe">
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-bold">Adresse</label>
                            <textarea name="adresse" class="form-control @error('adresse') is-invalid @enderror" rows="2" placeholder="Adresse complète">{{ old('adresse', $utilisateur->adresse ?? '') }}</textarea>
                            @error('adresse')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-warning">{{ isset($utilisateur) ? '💾 Modifier' : '➕ Ajouter' }}</button>
                        @if(isset($utilisateur))
                            <a href="{{ route('utilisateurs.index') }}" class="btn btn-secondary">❌ Annuler</a>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <!-- Tableau des utilisateurs -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr><th>Matricule</th><th>Nom complet</th><th>Email</th><th>Rôle</th><th>Téléphone</th><th>Statut</th><th class="text-center">Actions</th></tr>
                </thead>
                <tbody>
                    @forelse($utilisateurs as $user)
                    <tr>
                        <td>{{ $user->code_user }}</td>
                        <td>{{ $user->prenom }} {{ $user->nom }}</td>
                        <td>{{ $user->email }}</td>
                        <td>@if($user->role == 'administrateur')<span class="badge bg-danger">👑 Admin</span>@elseif($user->role == 'technicien')<span class="badge bg-warning text-dark">🔧 Technicien</span>@else<span class="badge bg-info">👤 Client</span>@endif</td>
                        <td>{{ $user->telephone ?? '—' }}</td>
                        <td><span class="badge bg-{{ $user->actif ? 'success' : 'secondary' }}">{{ $user->actif ? 'Actif' : 'Inactif' }}</span></td>
                        <td class="text-center">
                            <div class="btn-group" role="group">
                                <a href="{{ route('utilisateurs.edit', $user->code_user) }}" class="btn btn-sm btn-primary">✏️</a>
                                <a href="{{ route('utilisateurs.toggle', $user->code_user) }}" class="btn btn-sm btn-{{ $user->actif ? 'secondary' : 'success' }}" onclick="return confirm('{{ $user->actif ? 'Désactiver' : 'Activer' }} cet utilisateur ?')">{{ $user->actif ? '🔴' : '🟢' }}</a>
                                <form action="{{ route('utilisateurs.destroy', $user->code_user) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer définitivement cet utilisateur ?')">@csrf @method('DELETE')<button type="submit" class="btn btn-sm btn-danger">🗑️</button></form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center text-muted py-4">Aucun utilisateur enregistré.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($utilisateurs->hasPages())
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="text-muted">Affichage de {{ $utilisateurs->firstItem() ?? 0 }} à {{ $utilisateurs->lastItem() ?? 0 }} sur {{ $utilisateurs->total() }} utilisateur(s)</div>
                <div>{{ $utilisateurs->links('pagination::bootstrap-5') }}</div>
            </div>
        @endif
    </div>
</div>
@endsection

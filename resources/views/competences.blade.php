@extends('template')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-dark text-white">
        <h3 class="mb-0">📋 Gestion des Compétences</h3>
    </div>
    <div class="card-body">

        <!-- Formulaire d'ajout/modification -->
        <div class="card mb-4">
            <div class="card-header bg-light">
                <h5 class="mb-0">{{ isset($competence) ? '✏️ Modifier la compétence' : '➕ Ajouter une compétence' }}</h5>
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

                @if(isset($competence))
                    <form action="{{ route('competences.update', $competence->code_comp) }}" method="POST">
                    @csrf
                    @method('PUT')
                @else
                    <form action="{{ route('competences.store') }}" method="POST">
                    @csrf
                @endif
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Libellé <span class="text-danger">*</span></label>
                            <input type="text" name="label_comp"
                                   class="form-control @error('label_comp') is-invalid @enderror"
                                   value="{{ old('label_comp', $competence->label_comp ?? '') }}"
                                   placeholder="Ex: Développement Web">
                            @error('label_comp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Description</label>
                            <input type="text" name="description_comp"
                                   class="form-control @error('description_comp') is-invalid @enderror"
                                   value="{{ old('description_comp', $competence->description_comp ?? '') }}"
                                   placeholder="Description de la compétence...">
                            @error('description_comp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-warning">
                            {{ isset($competence) ? '💾 Modifier' : '➕ Ajouter' }}
                        </button>
                        @if(isset($competence))
                            <a href="{{ route('competences.index') }}" class="btn btn-secondary">❌ Annuler</a>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <!-- Tableau des compétences -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Code</th>
                        <th>Libellé</th>
                        <th>Description</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($competences as $comp)
                    <tr>
                        <td>{{ $comp->code_comp }}</td>
                        <td>{{ $comp->label_comp }}</td>
                        <td>{{ $comp->description_comp ?? '—' }}</td>
                        <td class="text-center">
                            <a href="{{ route('competences.edit', $comp->code_comp) }}"
                               class="btn btn-sm btn-primary">✏️ Modifier</a>
                            <form action="{{ route('competences.destroy', $comp->code_comp) }}"
                                  method="POST" class="d-inline"
                                  onsubmit="return confirm('Supprimer cette compétence ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">🗑 Supprimer</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">Aucune compétence enregistrée.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($competences->hasPages())
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="text-muted">
                    Affichage de {{ $competences->firstItem() ?? 0 }} à {{ $competences->lastItem() ?? 0 }}
                    sur {{ $competences->total() }} compétence(s)
                </div>
                <div>
                    {{ $competences->links('pagination::bootstrap-5') }}
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

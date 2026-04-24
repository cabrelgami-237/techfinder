<?php

namespace App\Http\Controllers\web;  // ← Important : namespace avec 'web'

use App\Http\Controllers\Controller;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UtilisateurController extends Controller
{
    protected $perPage = 10;

    public function index()
    {
        $utilisateurs = Utilisateur::orderBy('created_at', 'desc')->paginate($this->perPage);
        return view('utilisateurs', compact('utilisateurs'));
    }

    public function create()
    {
        return view('utilisateurs_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:100',
            'prenom' => 'required|string|max:100',
            'email' => 'required|email|unique:utilisateurs,email',
            'role' => 'required|in:client,technicien,administrateur',
            'telephone' => 'nullable|string|max:20',
            'adresse' => 'nullable|string',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Génération du matricule unique
        $matricule = $this->genererMatricule();

        $utilisateur = new Utilisateur();
        $utilisateur->code_user = $matricule;
        $utilisateur->nom = $request->nom;
        $utilisateur->prenom = $request->prenom;
        $utilisateur->email = $request->email;
        $utilisateur->password = Hash::make($request->password);
        $utilisateur->role = $request->role;
        $utilisateur->telephone = $request->telephone;
        $utilisateur->adresse = $request->adresse;
        $utilisateur->actif = true;
        $utilisateur->save();

        session()->flash('toast', '✅ Utilisateur créé avec succès ! Matricule: ' . $matricule);
        session()->flash('toast_type', 'success');

        return redirect()->route('utilisateurs.index');
    }

    public function edit(string $id)
    {
        $utilisateur = Utilisateur::findOrFail($id);
        $utilisateurs = Utilisateur::orderBy('created_at', 'desc')->paginate($this->perPage);
        return view('utilisateurs', compact('utilisateurs', 'utilisateur'));
    }

    public function update(Request $request, string $id)
    {
        $utilisateur = Utilisateur::findOrFail($id);

        $request->validate([
            'nom' => 'required|string|max:100',
            'prenom' => 'required|string|max:100',
            'email' => 'required|email|unique:utilisateurs,email,' . $id . ',code_user',
            'role' => 'required|in:client,technicien,administrateur',
            'telephone' => 'nullable|string|max:20',
            'adresse' => 'nullable|string',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $utilisateur->nom = $request->nom;
        $utilisateur->prenom = $request->prenom;
        $utilisateur->email = $request->email;
        $utilisateur->role = $request->role;
        $utilisateur->telephone = $request->telephone;
        $utilisateur->adresse = $request->adresse;

        if ($request->filled('password')) {
            $utilisateur->password = Hash::make($request->password);
        }

        $utilisateur->save();

        session()->flash('toast', '✏️ Utilisateur modifié avec succès !');
        session()->flash('toast_type', 'success');

        return redirect()->route('utilisateurs.index');
    }

    public function destroy(string $id)
    {
        $utilisateur = Utilisateur::findOrFail($id);
        $matricule = $utilisateur->code_user;
        $utilisateur->delete();

        session()->flash('toast', '🗑️ Utilisateur ' . $matricule . ' supprimé avec succès !');
        session()->flash('toast_type', 'success');

        return redirect()->route('utilisateurs.index');
    }

    public function toggleActif(string $id)
    {
        $utilisateur = Utilisateur::findOrFail($id);
        $utilisateur->actif = !$utilisateur->actif;
        $utilisateur->save();

        $status = $utilisateur->actif ? 'activé' : 'désactivé';
        session()->flash('toast', "👤 Utilisateur {$status} avec succès !");
        session()->flash('toast_type', 'success');

        return redirect()->route('utilisateurs.index');
    }

    /**
     * Génère un matricule unique pour un utilisateur
     * Format: USR-20250421-1234
     */
    private function genererMatricule(): string
    {
        do {
            $prefix = 'USR';
            $date = date('Ymd');
            $random = str_pad(random_int(1, 9999), 4, '0', STR_PAD_LEFT);
            $matricule = $prefix . '-' . $date . '-' . $random;

            $existe = Utilisateur::where('code_user', $matricule)->exists();
        } while ($existe);

        return $matricule;
    }
}

<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Competence;
use Illuminate\Http\Request;

class competencesController extends Controller
{
    protected $perPage = 5;

    public function index()
    {
        $competences = Competence::paginate($this->perPage);
        return view('competences', compact('competences'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'label_comp' => 'required|string|max:255',
            'description_comp' => 'nullable|string',
        ]);

        Competence::create($request->only('label_comp', 'description_comp'));

        session()->flash('toast', 'Competence ajoutee avec succes !');
        session()->flash('toast_type', 'success');

        return redirect()->route('competences.index');
    }

    public function edit(string $id)
    {
        $competence = Competence::findOrFail($id);
        $competences = Competence::paginate($this->perPage);
        return view('competences', compact('competences', 'competence'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'label_comp' => 'required|string|max:255',
            'description_comp' => 'nullable|string',
        ]);

        $competence = Competence::findOrFail($id);
        $competence->update($request->only('label_comp', 'description_comp'));

        session()->flash('toast', 'Competence modifiee avec succes !');
        session()->flash('toast_type', 'success');

        return redirect()->route('competences.index');
    }

    public function destroy(string $id)
    {
        $competence = Competence::findOrFail($id);
        $competence->delete();

        session()->flash('toast', 'Competence supprimee avec succes !');
        session()->flash('toast_type', 'success');

        return redirect()->route('competences.index');
    }
}
<?php
namespace App\Http\Controllers\web;
use App\Http\Controllers\Controller;
use App\Models\Competence;
use Illuminate\Http\Request;
class competencesController extends Controller
{
    protected \ = 5;
    public function index()
    {
        \ = Competence::paginate(\->perPage);
        return view('competences', compact('competences'));
    }
    public function store(Request \)
    {
        \->validate([
            'label_comp' => 'required|string|max:255',
            'description_comp' => 'nullable|string',
        ]);
        Competence::create(\->only('label_comp', 'description_comp'));
        session()->flash('toast', 'Competence ajoutee avec succes !');
        session()->flash('toast_type', 'success');
        return redirect()->route('competences.index');
    }
    public function edit(string \)
    {
        \ = Competence::findOrFail(\);
        \ = Competence::paginate(\->perPage);
        return view('competences', compact('competences', 'competence'));
    }
    public function update(Request \, string \)
    {
        \->validate([
            'label_comp' => 'required|string|max:255',
            'description_comp' => 'nullable|string',
        ]);
        \ = Competence::findOrFail(\);
        \->update(\->only('label_comp', 'description_comp'));
        session()->flash('toast', 'Competence modifiee avec succes !');
        session()->flash('toast_type', 'success');
        return redirect()->route('competences.index');
    }
    public function destroy(string \)
    {
        \ = Competence::findOrFail(\);
        \->delete();
        session()->flash('toast', 'Competence supprimee avec succes !');
        session()->flash('toast_type', 'success');
        return redirect()->route('competences.index');
    }
}

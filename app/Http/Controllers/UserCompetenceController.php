<?php

  namespace App\Http\Controllers;

use App\Models\User_Competence;
use Illuminate\Http\Request;

class UserCompetenceController extends Controller
{
    public function index()
    {
        return response()->json(User_Competence::all(), 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'code_user' => 'required',
            'code_comp' => 'required',
        ]);

        $uc = User_Competence::create($data);

        return response()->json($uc, 201);
    }

    public function destroy($code_user, $code_comp)
    {
        User_Competence::where('code_user', $code_user)
            ->where('code_comp', $code_comp)
            ->delete();

        return response()->json(null, 204);
    }
}

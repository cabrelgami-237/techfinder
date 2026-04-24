<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Competence extends Model
{
    use HasFactory;

    protected $table = 'competences';
    protected $primaryKey = 'code_comp';
    public $incrementing = true; // Si code_comp est auto-incrémenté
    protected $keyType = 'int';
    public $timestamps = true;

    protected $fillable = [
        'label_comp',
        'description_comp',
    ];

    // Relations
    public function utilisateurs()
    {
        return $this->belongsToMany(Utilisateur::class, 'user_competences', 'code_comp', 'code_user');
    }

    public function interventions()
    {
        return $this->hasMany(Intervention::class, 'code_comp', 'code_comp');
    }

    public function userCompetences()
    {
        return $this->hasMany(UserCompetence::class, 'code_comp', 'code_comp');
    }
}

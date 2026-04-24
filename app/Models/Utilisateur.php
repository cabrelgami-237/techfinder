<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Utilisateur extends Model
{
    use HasFactory;

    protected $table = 'utilisateurs';
    protected $primaryKey = 'code_user';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'code_user',
        'nom',
        'prenom',
        'email',
        'password',
        'role',
        'telephone',
        'adresse',
        'actif'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'actif' => 'boolean',
    ];
}

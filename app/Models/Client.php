<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    // Definindo os campos que podem ser atribuídos em massa
    protected $fillable = [
        'name',
        'email',
        'phone',
        'is_active', // adicione outros campos se necessário
    ];
}

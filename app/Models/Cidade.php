<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    use HasFactory;

    /**
     * Define a relação com os diaristas
     *
     * @return void
     */

    public function diaristas()
    {
        // belongsToMany -> (N PARA N) UMA CIDADE PERTENCE A MUITOS USUÁRIOS(DIARISTAS)
        return $this->belongsToMany(User::class, 'cidade_diarista');
    }
}

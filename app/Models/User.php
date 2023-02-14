<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

     /**
     * Define a relação com as cidades atendidas pelo(a) diarista
     *
     * @return BelongsToMany
     */
    public function cidadesAtendidas():BelongsToMany
    {
        // belongsToMany -> (N PARA N) UM USUARIO PERTENCE A MUITAS CIDADES
        return $this->belongsToMany(Cidade::class, 'cidade_diarista');
    }


    /**
     * Escopo que filtra os (as) diaristas
     * @param Builder $query
     * @return Builder
     */
    public function scopeDiarista(Builder $query): Builder
    {
        return $query->where('tipo_usuario', 2);
    }

    /**
     * Escopo que filtra diaristas por código do IBGE
     *
     * @param Builder $query
     * @param integer $codigoIbge
     * @return Builder
     */
    public function scopeDiaristasAtendeCidade(Builder $query, int $codigoIbge): Builder
    {
        return $query->diarista()
                    ->whereHas('cidadesAtendidas', function($q) use ($codigoIbge) {
                        $q->where('codigo_ibge', $codigoIbge);
                    });
    }

    /**
     * Busca 6 diaristas por codigo do ibge
     *
     * @param integer $codigoIbge
     * @return Collection
     */
    static function diaristasDisponivelCidade(int $codigoIbge): Collection
    {
        return User::diaristasAtendeCidade($codigoIbge)->limit(6)->get();
    }

    /**
     * Retorna a quantidade de diaristas por codigo do ibge
     *
     * @param integer $codigoIbge
     * @return int
     */
    static function diaristasDisponivelCidadeTotal(int $codigoIbge): int
    {
        return User::diaristasAtendeCidade($codigoIbge)->count();
    }
}

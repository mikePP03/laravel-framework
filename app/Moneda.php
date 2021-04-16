<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $nombre
 * @property string $descripcion
 * @property string $abreviatura
 * @property int $idUsuario
 * @property User $user
 * @property Empresamoneda[] $empresamonedas
 * @property Empresamoneda[] $empresamonedas
 */
class Moneda extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'moneda';

    /**
     * @var array
     */
    protected $fillable = ['nombre', 'descripcion', 'abreviatura', 'idUsuario'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'idUsuario');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    // public function empresamonedas()
    // {
    //     return $this->hasMany('App\Empresamoneda', 'idMonedaPrincipal');
    // }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function empresamonedas()
    {
        return $this->hasMany('App\Empresamoneda', 'idMonedaAlternativa');
    }
}

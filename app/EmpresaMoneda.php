<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property float $cambio
 * @property int $activo
 * @property string $fechaRegistro
 * @property int $idEmpresa
 * @property int $idMonedaPrincipal
 * @property int $idMonedaAlternativa
 * @property int $idUsuario
 * @property string $created_at
 * @property string $updated_at
 * @property Empresa $empresa
 * @property Moneda $moneda
 * @property Moneda $moneda
 * @property User $user
 */
class EmpresaMoneda extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'empresamoneda';

    /**
     * @var array
     */
    protected $fillable = ['cambio', 'activo', 'fechaRegistro', 'idEmpresa', 'idMonedaPrincipal', 'idMonedaAlternativa', 'idUsuario', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function empresa()
    {
        return $this->belongsTo('App\Empresa', 'idEmpresa');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function moneda()
    {
        return $this->belongsTo('App\Moneda', 'idMonedaPrincipal');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function monedaA()
    {
        return $this->belongsTo('App\Moneda', 'idMonedaAlternativa');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'idUsuario');
    }
}

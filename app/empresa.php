<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $nombre
 * @property int $nit
 * @property string $sigla
 * @property string $telefono
 * @property string $correo
 * @property string $direccion
 * @property int $niveles
 * @property int $idusuario
 * @property string $created_at
 * @property string $updated_at
 */
class empresa extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'empresa';

    /**
     * @var array
     */
    protected $fillable = ['nombre', 'nit', 'sigla', 'telefono', 'correo', 'direccion', 'niveles', 'idusuario', 'created_at', 'updated_at'];

}

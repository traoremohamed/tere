<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_type_marche
 * @property string $libelle_type_marche
 * @property string $code_type_marche
 * @property boolean $flag_type_marche
 * @property string $created_at
 * @property string $updated_at
 */
class TypeMarche extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'type_marche';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_type_marche';

    /**
     * @var array
     */
    protected $fillable = ['libelle_type_marche', 'code_type_marche', 'flag_type_marche', 'created_at', 'updated_at'];

}

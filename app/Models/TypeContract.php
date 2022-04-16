<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_type_contrat
 * @property string $libelle_type_contrat
 * @property string $code_type_contrat
 * @property boolean $flag_type_contrat
 * @property string $created_at
 * @property string $updated_at
 */
class TypeContract extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'type_contract';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_type_contrat';

    /**
     * @var array
     */
    protected $fillable = ['libelle_type_contrat', 'code_type_contrat', 'flag_type_contrat', 'created_at', 'updated_at'];

}

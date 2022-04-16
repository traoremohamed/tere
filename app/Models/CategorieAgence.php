<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_cat_agence
 * @property string $libelle_cat_agence
 * @property boolean $flag_cat_agence
 * @property string $created_at
 * @property string $updated_at
 */
class CategorieAgence extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categorie_agence';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_cat_agence';

    /**
     * @var array
     */
    protected $fillable = ['libelle_cat_agence', 'flag_cat_agence', 'created_at', 'updated_at'];

}

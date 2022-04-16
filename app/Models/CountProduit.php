<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_count_prod
 * @property int $id_prod
 * @property float $count_click
 * @property string $created_at
 * @property string $updated_at
 */
class CountProduit extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'count_produit';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_count_prod';

    /**
     * @var array
     */
    protected $fillable = ['id_prod', 'count_click', 'created_at', 'updated_at'];

}

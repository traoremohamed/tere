<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_article
 * @property string $titre_article
 * @property string $description_article
 * @property boolean $flag_article
 * @property int $id_user
 * @property string $created_at
 * @property string $updated_at
 */
class Article08122021 extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'article';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_article';

    /**
     * @var array
     */
    protected $fillable = ['titre_article', 'description_article', 'flag_article', 'id_user', 'created_at', 'updated_at'];

}

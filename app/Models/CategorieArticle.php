<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_cat_article
 * @property string $categ_article
 * @property boolean $flag_cat_article
 * @property int $id_user
 * @property string $created_at
 * @property string $updated_at
 */
class CategorieArticle extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categorie_article';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_cat_article';

    /**
     * @var array
     */
    protected $fillable = ['categ_article', 'flag_cat_article', 'id_user', 'created_at', 'updated_at'];

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_article
 * @property string $titre_article
 * @property string $description_article
 * @property string $sous_titre
 * @property string $description_detaille
 * @property boolean $flag_article
 * @property int $id_user
 * @property string $image_article
 * @property string $lien_article
 * @property string $lien_video
 * @property int $id_categ_article
 * @property string $created_at
 * @property string $updated_at
 */
class Article extends Model
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
    protected $fillable = ['titre_article', 'description_article', 'sous_titre', 'description_detaille', 'flag_article', 'id_user', 'image_article', 'lien_article', 'lien_video', 'id_categ_article', 'created_at', 'updated_at'];

}

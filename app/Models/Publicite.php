<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_pub
 * @property string $lib_pub
 * @property string $descr_pub
 * @property string $image_pub
 * @property string $video_pub
 * @property boolean $flag_pub
 * @property int $id_user
 * @property string $created_at
 * @property string $updated_at
 */
class Publicite extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'publicite';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_pub';

    /**
     * @var array
     */
    protected $fillable = ['lib_pub', 'descr_pub', 'image_pub', 'video_pub', 'id_user', 'flag_pub', 'created_at', 'updated_at'];

}

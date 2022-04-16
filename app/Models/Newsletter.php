<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_new
 * @property string $email_new
 * @property boolean $flag_new
 * @property string $created_at
 * @property string $updated_at
 */
class Newsletter extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'newsletter';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_new';

    /**
     * @var array
     */
    protected $fillable = ['email_new', 'flag_new', 'created_at', 'updated_at'];

}

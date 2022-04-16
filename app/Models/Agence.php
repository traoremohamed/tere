<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_agence
 * @property string $type_agence
 * @property string $nom_agence
 * @property string $contact_tel_agence
 * @property string $contact_mail_agence
 * @property string $info_compl_agence
 * @property boolean $flag_agence
 * @property string $image_agence
 * @property string $lat_agence
 * @property string $long_agence
 * @property int $id_user
 * @property string $updated_at
 * @property string $created_at
 */
class Agence extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'agence';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_agence';

    /**
     * @var array
     */
    protected $fillable = ['type_agence', 'nom_agence', 'contact_tel_agence', 'contact_mail_agence', 'info_compl_agence', 'flag_agence', 'image_agence', 'lat_agence', 'long_agence', 'id_user', 'updated_at', 'created_at'];

}

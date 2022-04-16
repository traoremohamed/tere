<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_contact
 * @property string $nom_prenom_contact
 * @property string $email_contact
 * @property string $contact_contact
 * @property string $sujet_contact
 * @property string $message_contact
 * @property boolean $flag_contact
 * @property string $created_at
 * @property string $updated_at
 */
class Contact extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'contact';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_contact';

    /**
     * @var array
     */
    protected $fillable = ['nom_prenom_contact', 'email_contact', 'contact_contact', 'sujet_contact', 'message_contact', 'flag_contact', 'created_at', 'updated_at'];

}

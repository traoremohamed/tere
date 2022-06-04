<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class consommable extends Model
{
    use HasFactory;
    protected $fillable = [
        "rapport_id",
        "designation",
        "unite",
        "quantite",
      ];

    public function Rapport()
    {
        return $this->belongsTo(rapport::class,'rapport_id','id');
    }

      
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class projection extends Model
{
    use HasFactory;
    protected $fillable = [
        "rapport_id",
        "designation",
        "dateprojection",
      ];
    public function Rapport()
    {
          return $this->belongsTo(rapport::class,'rapport_id','id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rapport extends Model
{
    use HasFactory;
    protected $fillable = [
        "titre",
        "nomprojet",
        "datejour",
        "nomchef",
        "contact",
      ];

    public function Projection(){
        return $this->hasMany(projection::class);
    }
    public function Intervenant(){
        return $this->hasMany(intervenant::class);
    }
    public function Consommable(){
        return $this->hasMany(consommable::class);
    }
    public function Machine(){
        return $this->hasMany(machine::class);
    }
    public function Travaux(){
        return $this->hasMany(travaux::class);
    }

    public function Livraison(){
        return $this->hasMany(livraison::class);
    }

}

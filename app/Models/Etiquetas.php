<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etiquetas extends Model
{

    public function productos() {
        return $this->belongsToMany('App\Models\Productos');
        }
    use HasFactory;
}



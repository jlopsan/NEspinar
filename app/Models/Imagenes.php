<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imagenes extends Model
{
    protected $fillable = ["image", "producto_id"];

    public function producto() {
        return $this->belongsTo('App\Models\Productos');
        }

    use HasFactory;
}

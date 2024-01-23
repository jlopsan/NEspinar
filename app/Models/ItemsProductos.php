<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemsProductos extends Model
{
    use HasFactory;
    protected $fillable = ['items_id', 'productos_id', 'value'];
    
    public function item() {
        return $this->hasOne('App\Models\Items', 'id', 'items_id');
    }
}

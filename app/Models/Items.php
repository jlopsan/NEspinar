<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Items extends Model
{

    public function categoria()
    {

        return $this->belongsTo('App\Models\Categorias', 'categoria_id');
    }

    public function productos()
    {
        return $this->belongsToMany('App\Models\Productos')->withPivot('value');
    }

    public function itemsProducto()
    {
        return $this->hasOne('App\Models\ItemsProductos', 'items_id');
    }

    public function itemsProductos()
    {
        return $this->hasMany('App\Models\ItemsProductos', 'items_id');
    }

    // Recupera todos los valores de un ítem
    public static function recuperarValores($idItem) {
        $valores = DB::select(DB::raw("SELECT value FROM items_productos WHERE items_id = '$idItem' GROUP BY value ORDER BY value"));
        // Limpiamos los valores obtenidos de cualquier posible etiqueta HTML
        /* foreach ($valores as $key => $value) {
            $valores[$key]->value = strip_tags($value->value); 
        } */
        // Quitamos los elementos del array que pudieran estar repetidos después de haber quitado las etiquetas HTML
        $valores = array_unique($valores, SORT_REGULAR);
        return $valores;

    }
    use HasFactory;
}

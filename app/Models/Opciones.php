<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opciones extends Model
{
    use HasFactory;

    // Esta función convierte la tabla de opciones en un array usando el campo llamado "key" como clave 
    // y el campo llamado "value" como valor. Está pensada para convertir la colección Opciones:all() en un array
    // indexado por el campo "key", para usarlo en las vistas con más comodidad de la colección.
    public static function convertToArray(){
        $collection = Opciones::all();
        $keys=$collection->pluck('key')->all();
        $values=$collection->pluck('value')->all();
        return array_combine($keys, $values);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use DB;

class Productos extends Model
{

    protected $fillable = ["name", "remarks", "dimensions", "image", "categoria_id"];

    /* Relación tablas*/
    public function categoria()
    {
        return $this->belongsTo('App\Models\Categorias');
    }

    public function etiquetas()
    {
        return $this->belongsToMany('App\Models\Etiquetas');
    }

    public function items()
    {
        return $this->belongsToMany('App\Models\Items')->orderBy('order')->withPivot('value');
    }

    public function imagenes()
    {
        return $this->hasMany('App\Models\Imagenes', 'producto_id');
    }
    use HasFactory;
    /*Fin Relación tablas*/

    /*Te recupera todos los productos de todas las categorias y te saca un producto random para que vaya variando la foto del front de la zona de colecciones */
    public static function recuperarProductosFront()
    {
        $listaCategorias = Categorias::all();
        $listaProductos = array();
        foreach ($listaCategorias as $categoria) {
            if ($categoria->productos->count() > 0) {
                $listaProductos[] = $categoria->productos->random();
            }
        }
        return $listaProductos;
    }

    // Función que devuelve los productos que coinciden con un valor concreto de un ítem
    public static function recuperarPorCategoriaDestacado($idCategoria, $iditem, $valueItem) {
        $elementosPorPagina = Opciones::where('key', 'paginacion_cantidad_elementos')->first()->value;
        // Si el valor del ítem destacado tiene algo asignado, buscamos todos los productos con ese valor en ese ítem.
        // En cambio, si el ítem destacado no tiene valor asignado, buscamos todos los productos con una cadena vacía en ese ítem.
        if ($valueItem == "Sin Valor" || $valueItem == "Sin valor") {
            $productos = Productos::select('productos.id', 'productos.name', 'productos.image', 'categorias.name as categoriaName')
                                    ->join("categorias", "productos.categoria_id", "categorias.id")
                                    ->join("items_productos", "productos.id", "items_productos.productos_id")
                                    ->where("productos.categoria_id", $idCategoria)
                                    ->where("items_productos.items_id", $iditem)
                                    ->where("items_productos.value", "=", "")
                                    ->orWhere("items_productos.value", "=", "<p><br></p>")
                                    ->orWhere("items_productos.value", "=", "<p></p>")
                                    ->orWhereNull("items_productos.value")
                                    ->distinct()->orderBy('productos.name')->paginate($elementosPorPagina);
                                }
        else {
            $productos = Productos::select('productos.id', 'productos.name', 'productos.image', 'categorias.name as categoriaName')
                                    ->join("categorias", "productos.categoria_id", "categorias.id")
                                    ->join("items_productos", "productos.id", "items_productos.productos_id")
                                    ->where("productos.categoria_id", $idCategoria)
                                    ->where("items_productos.items_id", $iditem)
                                    ->where("items_productos.value", "=", "$valueItem")
                                    ->distinct()->orderBy('productos.name')->paginate($elementosPorPagina);
        }
        return $productos;
    }

    

    /*Recupera los productos de una categoria ordenados aleatoriamente y los pagina cada X objetos */
    public static function recuperarPorCategoria($id)
    {
        $listaProductos = Productos::where('categoria_id', $id)->orderBy('name');
        $elementosPorPagina = Opciones::where('key', 'paginacion_cantidad_elementos')->first()->value;
        return $listaProductos->paginate($elementosPorPagina);
    }
    /*_______________________________________buscador productos backoffice__________________________________________________ */

    /* Buscador front/back que segun en la categoria en la que se encuentra ejecutara la consulta contra esa categoria */
    /* Si el idCategoria es NULL, busca en todas las categorias*/
    public static function busquedaProductos($idCategoria, $textoBusquedaOG)
    {
        $resultadoBusqueda = collect();  // Creamos colección vacía para ir añadiendo los resultados de las búsquedas
        if ($textoBusquedaOG == "" && $idCategoria != NULL) {
            // CASO 1: No hay texto de búsqueda, pero sí hay categoría --> Buscamos todos los productos de la categoría
            $resultadoBusqueda = $resultadoBusqueda->merge(Productos::with('categoria')
                ->where("productos.categoria_id", "$idCategoria")->distinct()->get());
        } else if ($textoBusquedaOG == "" && $idCategoria == NULL) {
            // CASO 2: No hay texto de búsqueda ni categoría --> Buscamos todos los productos
            $resultadoBusqueda = $resultadoBusqueda->merge(Productos::all());
        } else {
            // CASO 3: Hay texto de búsqueda --> Buscamos productos que coincidan con el texto de búsqueda
            $textoLimpio = self::preparacionString($textoBusquedaOG); // Limpia el texto de palabras comunes (como artículos) y lo trocea en palabras individuales
            foreach ($textoLimpio as $textoBusqueda) {
                if ($idCategoria != NULL) {
                    $resultadoBusqueda = $resultadoBusqueda->merge(Productos::with('categoria')
                        ->where("productos.categoria_id", "$idCategoria")
                        ->where("productos.name", "like", "%$textoBusqueda%")->distinct()->get());
                } else {
                    $resultadoBusqueda = $resultadoBusqueda->merge(Productos::where("productos.name", "like", "%$textoBusqueda%")->get());
                }
                
            }
        }
        // Paginamos el resultado
        $resultadoPaginado = new LengthAwarePaginator($resultadoBusqueda, count($resultadoBusqueda), 9);
        $resultadoPaginado->appends(['textoBusqueda' => $textoBusquedaOG]);
        if ($idCategoria != NULL) $resultadoPaginado->appends(['idCategoria' => $idCategoria]);
        return $resultadoPaginado;
    }
    /*_______________________________________buscador productos backoffice__________________________________________________ */


    /*__________________________________________________buscador usuario__________________________________________________ */    

   

    public static function preparacionString($cadena) {
        /*
            Recibe una cadena string 

            Esta funcion limpia palabras sencillas del texto de busqueda que estén contenidas en $diccionario.
            Tambien las separa por palabras o por la combinacion de palabras segun si están entrecomilladas o no
            Todas estas palabras se van añadiendo a un array el cual es el que se devuelve
        */
        $valores = explode('"', $cadena);
        $txtReady = [];
    
        $diccionario = [
            'el', 'la', 'los', 'las', 'un', 'una', 'unos', 'unas', 'y', 'e', 'o', 'u',
            'a', 'ante', 'bajo', 'cabe', 'con', 'contra', 'de', 'desde', 'durante',
            'en', 'entre', 'hacia', 'hasta', 'mediante', 'para', 'por', 'según',
            'sin', 'sobre', 'tras', 'durante'
        ];
    
        foreach ($valores as $index => $valor) {
            $valor = trim($valor);
    
            if (!empty($valor)) {
                if ($index % 2 === 0) {
                    $palabrasFiltradas = array_diff(explode(' ', $valor), $diccionario);
                    $txtReady = array_merge($txtReady, $palabrasFiltradas);
                } else {
                    $txtReady[] = $valor;
                }
            }
        }
    
        return $txtReady;
    }
    
    public static function buscador($data)
    {
        //Funcion la cual contiene los tres buscadores de la pagina web el de categorias el de campos y el general
        //Segun los parametros almacenados dentro de $data y un if anidado se ejecuta una consulta a traves de eloquent u otra
        //busqueda por campos, $items!=null
        //busqueda por categoria $idCategoria!=null
        //busqueda general $txt!=null

        $txt = $data['txt'] ?? null;
        $idCategoria = $data['idCategoria'] ?? null;
        $items = $data['items'] ?? null;
        $page = $data['page']??null;

        $txtReady = null;
        if (!empty($txt)) {
            $txtReady = self::preparacionString($txt);
        }

        $results = null;

        if (!empty($items)) {
            $filteredItems = array_filter($items, function ($item) use ($idCategoria) {
                return $item['categoria_id'] == $idCategoria && !empty($item['texto']);
            });

            if (!empty($filteredItems)) {
                 $results = Productos::select('prod1.id', 'prod1.name', 'prod1.image', 'categorias.name as categoriaName')
                ->from('productos as prod1')
                ->join('items_productos', 'prod1.id', '=', 'items_productos.productos_id')
                ->join('categorias', 'prod1.categoria_id', '=', 'categorias.id')
                ->where('categorias.id', $idCategoria)
                ->where(function ($query) use ($filteredItems) {
                    foreach ($filteredItems as $key => $item) {
                        $txtReadyItem = self::preparacionString($item['texto']);
                        $query->where(function ($query) use ($item, $txtReadyItem) {
                            $query->whereIn('prod1.id', function ($subquery) use ($item, $txtReadyItem) {
                                $subquery->select('items_productos.productos_id')
                                    ->from('items_productos')
                                    ->join('productos', 'productos.id', '=', 'items_productos.productos_id')
                                    ->join('items', 'items.id', '=', 'items_productos.items_id')
                                    ->where('items_productos.items_id', $item['item_id'])
                                    ->where('productos.id', DB::raw('prod1.id'))
                                    ->where(function ($subquery) use ($txtReadyItem) {
                                        foreach ($txtReadyItem as $value) {
                                            $subquery->orWhereRaw("cleanText(items_productos.value) LIKE ?", ['%' . $value . '%']);
                                        }
                                    });
                            });
                        });
                    }
                })
                ->groupBy('prod1.id', 'prod1.name', 'prod1.image', 'categorias.name');

                $results = $results->distinct()->paginate(9);


                if (!empty($page)) {
                        $results->setPageName('page')->appends(['page' => $page]);
                }

                return $results->appends(['items' => $filteredItems, 'categoria_id' => $idCategoria]);

            }
        } elseif (!empty($idCategoria)) {
            //buscador categorias
            if (!empty($txtReady)) {
                $results = Productos::select('productos.id', 'productos.name', 'productos.image', 'categorias.name as categoriaName')
                    ->join('items_productos', 'productos.id', '=', 'items_productos.productos_id')
                    ->join('categorias', 'productos.categoria_id', '=', 'categorias.id')
                    ->where('categorias.id', $idCategoria)
                    ->where(function ($query) use ($txtReady) {
                        foreach ($txtReady as $value) {
                            $query->orWhere(function ($query) use ($value) {
                                $query
                                    ->whereRaw("cleanText(items_productos.value) LIKE ?", ['%' . $value . '%']);
                            });
                            $query->orWhere(function ($query) use ($value) {
                                $query
                                    ->whereRaw("productos.name LIKE ?", ['%' . $value . '%']);
                            });
                        }
                    })
                    ->groupBy('productos.id', 'productos.name', 'productos.image', 'categorias.name')
                    ->distinct()
                    ->paginate(9);

                    if (!empty($page)) {
                        $results->setPageName('page')->appends(['page' => $page]);
                }

                return $results->appends(['textoBusqueda' => $data['txt']]);
            }
        } else {
            // Buscador general
            if (!empty($txtReady)) {
                $results = Productos::select('productos.id', 'productos.name', 'productos.image', 'categorias.name as categoriaName')
                    ->join('items_productos', 'productos.id', '=', 'items_productos.productos_id')
                    ->join('categorias', 'productos.categoria_id', '=', 'categorias.id')
                    ->where(function ($query) use ($txtReady) {
                        foreach ($txtReady as $value) {
                            $query->orWhere(function ($query) use ($value) {
                                $query
                                    ->whereRaw("cleanText(items_productos.value) LIKE ?", ['%' . $value . '%']);
                            });
                            $query->orWhere(function ($query) use ($value) {
                                $query
                                    ->whereRaw("productos.name LIKE ?", ['%' . $value . '%']);
                            });
                        }
                    })
                    ->groupBy('productos.id', 'productos.name', 'productos.image', 'categorias.name')
                    ->distinct()
                    ->paginate(9);
            
                if (!empty($page)) {
                    $results->setPageName('page')->appends(['page' => $page]);
                }
                                
                return $results->appends(['textoBusqueda' => $data['txt']]);
            }
                       
        }

        return null;
    }


    /*__________________________________________________buscador usuario__________________________________________________ */

}

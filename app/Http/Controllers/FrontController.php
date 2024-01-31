<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use App\Models\Categorias;
use App\Models\Opciones;
use App\Models\Items;
use Illuminate\Http\Request;
use stdClass;

class FrontController extends Controller
{
    public function index() {
        $productosList = Productos::recuperarProductosFront();
        $categoriasList = Categorias::orderBy('order')->get();
        $opciones = Opciones::convertToArray();
        return view('front.front', ['home'=>true, 'productosList'=>$productosList, 'categoriasList'=>$categoriasList,'opciones' => $opciones]);
    }

    public function show($id) {
        $p = Productos::find($id);
        $data['productos'] = $p;
        $categoria = Categorias::find($r->idCategoria);
        return view('categorias.show', $data);
    }

    /* Muestra todos los productos de una categoría. Si la categoría tiene un ítem destacado, muestra un selector
       con todos los valores de ese ítem */
    public function mostrarCategorias($id, Request $r) {
        $categoria = Categorias::find($id);
        $destacados = $categoria->items()->where('destacado', 1)->get();
        if (blank($r->textoBusqueda) && count($destacados) > 0) {
            // Si algún ítem de esta categoría está marcado como "destacado", se mostrará una vista para elegir
            // entre todos los valores de ese ítem. Excepto si estamos usando el buscador, en cuyo caso lanzaremos la búsqueda
            // en el else ignorando el ítem destacado.

            // Recuperamos todos los valores del item destacado
            $idItemDestacado = $destacados[0]->id;
            $valores = Items::recuperarValores($idItemDestacado);
            
            foreach (array_keys($valores) as $key) {
                $valores[$key]->value = strip_tags($valores[$key]->value);
            }

            $valores = array_unique($valores, SORT_REGULAR);
            
            $numProductosSinCategoria = self::compruebaSinCategorizar($idItemDestacado, $id);
            
            $objeto = new stdClass();
            $objeto->value = 'Sin Categorizar';

            if($numProductosSinCategoria > 0) {
                array_push($valores, $objeto);
            }
            
            $data['valores'] = $valores;
            $data['categoria'] = $categoria;
            $data['idItem'] = $idItemDestacado;
            $data['opciones'] = Opciones::convertToArray();
            $data['categoriasList'] = Categorias::orderBy('order')->get();
            return view('front.categorias_destacados', $data);
        }
        else {
            // Si no hay ningún producto destacado en esta categoría, se mostrarán todos los productos de la categoría.
            $data['idCategoria'] = $id;
            $data['txt'] = $r->textoBusqueda;

            $categoriasList = Categorias::orderBy('order')->get();
            $todosProductos = blank($r->textoBusqueda) ? Productos::recuperarPorCategoria($id) : Productos::buscador($data);
            $opciones = Opciones::convertToArray();
            if(empty($todosProductos))$msg = 'No hay resultados de búsqueda';
            return view('front.piezas_categorias', ['msg'=> $msg??"",'todosProductos'=>$todosProductos,'categoriasList'=>$categoriasList,'categoria' => $categoria,
            'textoBusqueda' => $r->textoBusqueda, 'opciones' => $opciones]);    
        }
    }

    public function compruebaSinCategorizar($iditem, $idCategoria) {
        return Productos::select("productos.id", "productos.name", "productos.image", "categorias.name as categoriaName")
                                    ->leftJoin("items_productos", function($join) use ($iditem) {
                                        $join->on("productos.id", "=", "items_productos.productos_id")
                                        ->where("items_productos.items_id", "=", $iditem);    
                                    })
                                    ->leftJoin("categorias", "productos.categoria_id", "=", "categorias.id")
                                    ->leftJoin("items", "categorias.id", "=", "items.categoria_id")
                                    ->where("productos.categoria_id", "=", $idCategoria)
                                    ->whereNull("items_productos.value")
                                    ->distinct('productos.id')
                                    ->count();
    }

    /* Muestra todos los productos de una categoría, filtrados por el valor de un ítem destacado */
    public function vistaPorItemDestacado($idCategoria, $idItem, $valueItem) {
        if ($idItem == -1) {
            // Si el id del item destacado es -1, se mostrarán todos los productos de la categoría (sin filtrar por ítem)
            $categoria = Categorias::find($idCategoria);
            $categoriasList = Categorias::orderBy('order')->get();
            $todosProductos = Productos::recuperarPorCategoria($idCategoria);
            $opciones = Opciones::convertToArray();
            if(empty($todosProductos))$msg = 'No hay resultados de búsqueda';
            return view('front.piezas_categorias', ['msg'=> $msg??"",'todosProductos'=>$todosProductos,'categoriasList'=>$categoriasList,'categoria' => $categoria,
            'opciones' => $opciones]);    
        } 
        else {
            // Si el id del item destacado es distinto de -1, se mostrarán todos los productos de la categoría que tengan el valor seleccionado en $valueItem
            $categoria = Categorias::find($idCategoria);
            $categoriasList = Categorias::orderBy('order')->get();
            $todosProductos = Productos::recuperarPorCategoriaDestacado($idCategoria, $idItem, $valueItem);
            $opciones = Opciones::convertToArray();
            if(empty($todosProductos))$msg = 'No hay resultados de búsqueda';
            return view('front.piezas_categorias', ['msg'=> $msg??"",'todosProductos'=>$todosProductos,'categoriasList'=>$categoriasList,'categoria' => $categoria,
            'opciones' => $opciones]);    
        }
    }


    /*Funcion buscador categorías para que solo funcione en la vista de la categoria seleccionada*/
    public function buscadorCategorias(Request $r) {
        $categoria = Categorias::find($r->idCategoria);
        $data['idCategoria'] = $r->idCategoria;
        $data['txt'] = $r->textoBusqueda;
        $data['page'] = $r->page;


        $categoriasList = Categorias::orderBy('order')->get();
        $todosProductos = blank($r->textoBusqueda) ? Productos::recuperarPorCategoria($id) : Productos::buscador($data);
        $opciones = Opciones::convertToArray();
        if(empty($todosProductos))$msg = 'No hay resultados de búsqueda';
        return view('front.piezas_categorias', ['productosList'=>$productosList, 'categoriasList'=>$categoriasList, 'opciones' => $opciones, 
                    'msg'=> $msg??"",'textoBusqueda'=> $r->textoBusqueda, 'todosProductos'=>$todosProductos,
                    'categoriasList'=>$categoriasList, 'idCategoria' => $r->idCategoria, 'categoria' => $categoria]);
    }

    /*Funcion vista buscador prepara todas las categorías e items para mostrarlos en la página del buscador*/
    public function vistaBuscador(Request $r) {
        $categoriasList = Categorias::orderBy('order')->get();
        $opciones = Opciones::convertToArray();
        return view('front.buscador', ['categoriasList'=>$categoriasList, 'textoBusqueda' => $r->textoBusqueda, 'opciones' => $opciones]);
    }

    /*Funcion buscador general front*/ 
    public function buscadorGeneral(Request $r) {
        $data['txt'] = $r->textoBusqueda;
        $data['page'] = $r->page;
        $categoriasList = Categorias::orderBy('order')->get();
        
        $todosProductos =  Productos::buscador($data);
        $opciones = Opciones::convertToArray();
    
        if ($todosProductos===null){
            $msg = 'No hay resultados de búsqueda';    
        } 
        return view('front.piezas_categorias', 
        [
            'textoBusqueda'=> $r->textoBusqueda,
            'msg'=> $msg??"",
            'todosProductos'=>$todosProductos,
            'categoriasList'=>$categoriasList,
            'textoBusqueda' => $r->textoBusqueda, 
            'opciones' => $opciones
        ]);
    }


    /*Funcion por campos según categoría front*/ 
    public function buscadorPorCampos(Request $r) {
        $data['idCategoria'] = $r->categoria_id;
        $data['items'] = $r->items;
        $data['page'] = $r->page;

        $categoriasList = Categorias::orderBy('order')->get();
        $opciones = Opciones::convertToArray();
        $todosProductos = Productos::buscador($data);

        if ($todosProductos===null) {
            $msg = 'No hay resultados de búsqueda';   
        }        

        return view('front.piezas_categorias', ['categoria_id' => $r->categoria_id,'msg'=>$msg??"", 'items' => $r->items,'opciones' => $opciones, 'todosProductos'=>$todosProductos, 'categoriasList'=>$categoriasList]);
    }

    // Muestra la vista de "acerca de"
    public function acercaDe() {
        $opciones = Opciones::convertToArray();
        $categoriasList = Categorias::orderBy('order')->get();
        return view('front.acerca_de', ['opciones' => $opciones, 'categoriasList'=>$categoriasList]);
    }

    // Muestra la vista de "política de privacidad"
    public function politicaPrivacidad() {
        $opciones = Opciones::convertToArray();
        $categoriasList = Categorias::orderBy('order')->get();
        return view('front.politica_privacidad', ['opciones' => $opciones, 'categoriasList'=>$categoriasList]);
    }

    // Muestra la vista de "política de cookies"
    public function politicaCookies() {
        $opciones = Opciones::convertToArray();
        $categoriasList = Categorias::orderBy('order')->get();
        return view('front.politica_cookies', ['opciones' => $opciones, 'categoriasList'=>$categoriasList]);
    }

    // Muestra la vista de "términos de uso"
    public function terminosUso() {
        $opciones = Opciones::convertToArray();
        $categoriasList = Categorias::orderBy('order')->get();
        return view('front.terminos_uso', ['opciones' => $opciones, 'categoriasList'=>$categoriasList]);
    }

}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorias;
use App\Models\Productos;

class CategoriasController extends Controller
{
    public function __construct() {
        $this->middleware("auth");
    }

    public function index() {
        $categoriasList = Categorias::orderBy('order')->get();
        return view('categorias.all', ['categoriasList'=>$categoriasList]);
    }

    public function show($id) {
        $p = Categorias::find($id);
        $data['categorias'] = $p;
        return view('categorias.show', $data);
    }

    public function create() {
        return view('categorias.form');
    }

    public function store(Request $r) {
        $p = new Categorias();
        $p->name = $r->name;
        $maxOrder = Categorias::where('id', $r->id)->max('order');
        $p->order = $maxOrder + 1;
        $p->save();
        $p->save();
        Categorias::query()->update([
            'order' => \DB::raw('id')
        ]);
        return redirect()->route('categorias.index');
    }

    public function edit($id) {
        $categorias = Categorias::find($id);
        //var_dump(array('categoria' => $categorias));
        return view('categorias.form', array('categoria' => $categorias));
        
    }

    public function update($id, Request $r) {
        $p = Categorias::find($id);
        $p->name = $r->name;
        $p->save();
        return redirect()->route('categorias.index');
    }

    public function destroy($id) {
        Productos::where('categoria_id', $id)->delete();        
        $p = Categorias::find($id);
        $p->delete();
        return redirect()->route('categorias.index');
    }


    // Cambia el orden de un ítem en una categoría.
    // Recibe como parámetros el id del cat, el orden actual y la cantidad de posiciones a cambiar, que puede ser -1 o 1.
    // Si $cantidad == -1, se permuta el cat con el que tenga un orden justo menor.
    // Si $cantidad == 1, se permuta el cat con el que tenga un orden justo mayor.
    public function cambiarOrden($id, $orden, $cantidad) {
       
        $cat = Categorias::find($id);
        $categoria_id = $cat->categoria_id;
        $order = $cat->order;
        if ($cantidad == -1) {
            $catAnterior = Categorias::where('order', '<', $order)->orderBy('order', 'desc')->first();
            if ($catAnterior) {
                $cat->order = $catAnterior->order;
                $cat->save();
                $catAnterior->order = $order;
                $catAnterior->save();
            }
        } else {
            $catSiguiente = Categorias::where('order', '>', $order)->orderBy('order')->first();
            if ($catSiguiente) {
                $cat->order = $catSiguiente->order;
                $cat->save();
                $catSiguiente->order = $order;
                $catSiguiente->save();
            }
        }
        return redirect()->route('categorias.index');
    }



    public function get_items($id_categoria) {
        $lista_items = Categorias::find($id_categoria)->items;
        return response()->json($lista_items);
    }
} 


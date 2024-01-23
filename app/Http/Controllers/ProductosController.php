<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productos;
use App\Models\Categorias;
use App\Models\ItemsProductos;
use App\Models\Imagenes;
use App\Models\Items;
use App\Models\Opciones;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProductosController extends Controller
{   
    
    public function __construct() {
        $this->middleware("auth");
    }

    public function index() {
        $elementosPorPagina = Opciones::where('key', 'paginacion_back')->first()->value;
        $productosList = Productos::with('categoria')->paginate($elementosPorPagina);
        $categorias = Categorias::orderBy('name')->get();
        return view('productos.all', ['productosList'=>$productosList, 'categorias'=>$categorias]);
    }

    public function show($id) {
        $p = Productos::find($id);
        return view('productos.show', array('producto' => $p));
    }

    public function create() {
        $data ['categorias'] = Categorias::all();
        $data['opciones'] = Opciones::convertToArray();
        return view('productos.form', $data);
    }

    //Hemos cambiado cosa aquí
    public function store(Request $r) {
        $image = $r->file('image');
        $images = $r->file('images');
        $p = new Productos($r->all());
        if (!blank($image)) {
            $image_name = $image->getClientOriginalName();
            $p->save();
            $image->storeAs("public/$p->id", $image_name);
            Storage::setVisibility("public/$p->id", "public");
            Storage::setVisibility("public/$p->id/$image_name", "public");

            // Genera miniatura
            $miniatura = Image::make($image);
            // Vamos a hacer que la imagen miniatura mida 1000 px en su lado más largo
            if ($miniatura->height() > $miniatura->width()) {
                // Altura = 1000, anchura proporcional
                $miniatura->resize(1000, null, function ($constraint) {$constraint->aspectRatio();});
            } else {
                // Anchura = 1000, altura proporcional
                $miniatura->resize(null, 1000, function ($constraint) {$constraint->aspectRatio();});  
            }
            $miniatura_name = 'mini_' . $image_name;
            $miniatura->save(storage_path("app/public/$p->id/$miniatura_name"));
            Storage::setVisibility("public/$p->id/$miniatura_name", "public");            
        }
        $p->image = $image_name ?? '';
        $p->save();
       
        if(!blank($images)){
            foreach($images as $i){
                $i_name = $i->getClientOriginalName();
                $img = new Imagenes();
                $i->storeAs("public/$p->id", $i_name);
                $img->producto_id = $p->id;
                $img->image = $i_name;
                $img->save();
                // Genera miniatura
                $miniatura = Image::make($i);
                // Vamos a hacer que la imagen miniatura mida 1000 px en su lado más largo
                if ($miniatura->height() > $miniatura->width()) {
                    // Altura = 1000, anchura proporcional
                    $miniatura->resize(1000, null, function ($constraint) {$constraint->aspectRatio();});
                } else {
                    // Anchura = 1000, altura proporcional
                    $miniatura->resize(null, 1000, function ($constraint) {$constraint->aspectRatio();});  
                }
                $miniatura_name = 'mini_' . $i_name;
                $miniatura->save(storage_path("app/public/$p->id/$miniatura_name"));
                Storage::setVisibility("public/$p->id/$miniatura_name", "public");            
            }
        }
        //$p->etiquetas()->attach($r->etiquetas);
        //$p->items()->attach($r->items);
        foreach($r->items as $item){ 
            $itemProducto = new ItemsProductos();
            $itemProducto->productos_id = $p->id;
            $itemProducto->value = $item['value'] ?? '-';
            $itemProducto->items_id = $item['id'];
            $itemProducto->save();
        }
        return redirect()->route('buscadorBack', ['idCategoria' => $p->categoria_id]);
    }

    public function edit($id) {
        $producto = Productos::find($id);
        $categorias = Categorias::all();
        $opciones = Opciones::convertToArray();
        $items = Items::where('categoria_id', $producto->categoria_id)->orderBy('order')->with(['itemsProducto' => function($query) use ($id){
            $query->where('productos_id', $id);
        }])->get();
        $image = Storage::url("$producto->id/mini_$producto->image");
        return view('productos.form', compact('producto', 'categorias', 'items', 'image', 'opciones'));
    }

    public function update(Request $r, $id) {
        $p = Productos::find($id);
        $p->name = $r->name;
        $p->categoria_id = $r->categoria_id;
        if(!blank($r->file('image'))){
            $deleteImage = $p->image;
            Storage::delete("public/" . $id . "/" . $deleteImage);
            $image = $r->file('image');
            $image_name = $image->getClientOriginalName();
            $image->storeAs("public/$p->id", $image_name);
            Storage::setVisibility("public/$p->id", "public");
            Storage::setVisibility("public/$p->id/$image_name", "public");
            $p->image = $image_name;
            // Genera miniatura
            $miniatura = Image::make($image);
            // Vamos a hacer que la imagen miniatura mida 1000 px en su lado más largo
            if ($miniatura->height() > $miniatura->width()) {
                // Altura = 1000, anchura proporcional
                $miniatura->resize(1000, null, function ($constraint) {$constraint->aspectRatio();});
            } else {
                // Anchura = 1000, altura proporcional
                $miniatura->resize(null, 1000, function ($constraint) {$constraint->aspectRatio();});  
            }
            $miniatura_name = 'mini_' . $image_name;
            $miniatura->save(storage_path("app/public/$p->id/$miniatura_name"));
            Storage::setVisibility("public/$p->id/$miniatura_name", "public");            

        }
        $deleteImages = $r->deleteImages ?? [];
        foreach($deleteImages as $di){
            $img = Imagenes::where('image', $di)->where('producto_id', $p->id)->first();
            Storage::delete("public/" . $img->producto_id . "/" . $di);
            $img->delete();
        }
        $images = $r->file('images');
        if(!blank($images)){
            foreach($images as $i){
                $i_name = $i->getClientOriginalName();
                $i->storeAs("public/$p->id", $i_name);
                $img = new Imagenes();
                $img->producto_id = $p->id;
                $img->image = $i_name;
                $img->save();
                // Genera miniatura
                $miniatura = Image::make($i);
                // Vamos a hacer que la imagen miniatura mida 1000 px en su lado más largo
                if ($miniatura->height() > $miniatura->width()) {
                    // Altura = 1000, anchura proporcional
                    $miniatura->resize(1000, null, function ($constraint) {$constraint->aspectRatio();});
                } else {
                    // Anchura = 1000, altura proporcional
                    $miniatura->resize(null, 1000, function ($constraint) {$constraint->aspectRatio();});  
                }
                $miniatura_name = 'mini_' . $i_name;
                $miniatura->save(storage_path("app/public/$p->id/$miniatura_name"));
                Storage::setVisibility("public/$p->id/$miniatura_name", "public");            
            }
        }
       
        foreach($r->items as $item){ 
            $itemProducto = ItemsProductos::where('items_id', $item['id'])->where('productos_id', $id)->first() ?? new ItemsProductos();
            if(!blank($itemProducto)){
                $itemProducto->value = $item['value'] ?? '-';
                if(!blank($itemProducto->item) && $itemProducto->item->destacado) $itemProducto->value = rtrim(strip_tags($itemProducto->value));
                $itemProducto->productos_id = $id;
                $itemProducto->items_id = $item['id'];
                $itemProducto->save();
            }

        }
        $p->save();
        return redirect()->route('buscadorBack', ['idCategoria' => $p->categoria_id]);
    }

    public function destroy($id) {
        $p = Productos::find($id);
        $deleteImage = $p->image;
        //Storage::delete('public/' . $id);
         Storage::DeleteDirectory('public/' . $id);
        $p->delete();
        $itemsProductos = ItemsProductos::where('productos_id', $id)->get();
        foreach($itemsProductos as $ip){
            $ip->delete();
        }
        $borrarImagenes = Imagenes::where('producto_id', $id)->get();
        foreach($borrarImagenes as $bi){
            $bi->delete();
        }
        return redirect()->route('buscadorBack', ['idCategoria' => $p->categoria_id]);

    }

    public function buscadorProductos(Request $r) {
        $categorias = Categorias::all();
        $productosList = Productos::busquedaProductos($r->idCategoria, $r->textoBusqueda);
        return view('productos.all', ['textoBusqueda'=> $r->textoBusqueda, 'productosList'=>$productosList, 'categorias'=>$categorias, 'idCategoria' => $r->idCategoria]);
    }
}
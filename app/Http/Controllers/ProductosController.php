<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productos;
use App\Models\Categorias;
use App\Models\ItemsProductos;
use App\Models\Imagenes;
use App\Models\Items;
use App\Models\Opciones;
use Illuminate\Support\Collection;
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

    //** Esta funcion va a sanear los datos de entrada pasa los &nbsp; a " " y los &amp a "&" y borrar todos los espacios innecesarios en medio del texto
    public function cleanDataEntry($string){
        $string = str_replace(['&nbsp;', '&amp;'], [' ', '&'], $string);
        $doubleSpaceEncontered = true; 
        while($doubleSpaceEncontered) {
            $doubleSpaceEncontered = false;
            $stringcopy = str_replace(['  '], [' '], $string);
            if($string != $stringcopy) {
                $string = $stringcopy;
                $doubleSpaceEncontered = true;
            }
        }
        $string = str_replace(['<p> ', ' </p>'], ['<p>', '</p>'], $string);
        $string = str_replace(['<br>'], [''], $string);
        return $string;
    }

    //** Esta función guarda una imagen asociada a un producto y crea su miniatura
    public function saveImage($image, $productId, $image_name){  
        $image->storeAs("public/$productId", $image_name);
        Storage::setVisibility("public/$productId/$image_name", "public");

        $miniatura = Image::make($image);
        if ($miniatura->height() > $miniatura->width()) {
            // Altura = 1000, anchura proporcional
            $miniatura->resize(1000, null, function ($constraint) {$constraint->aspectRatio();});
        } else {
            // Anchura = 1000, altura proporcional
            $miniatura->resize(null, 1000, function ($constraint) {$constraint->aspectRatio();});  
        }
        $miniatura_name = 'mini_' . $image_name;
        $miniatura->save(storage_path("app/public/$productId/$miniatura_name"));
        Storage::setVisibility("public/$productId/$miniatura_name", "public");

        $folderPath = storage_path("app/public/$productId");
        chmod($folderPath, 0755);
    }

    //** Funcion que guarda un registro de un producto
    public function store(Request $r) {
        
        $image = $r->file('image');
        $r->name = self::cleanDataEntry($r->name);
        $p = new Productos(['name' => self::cleanDataEntry($r->name), 'categoria_id' => $r->categoria_id]);
        if (!blank($image)) { //** Si existe una imagen principal esta se guarda
            $p->save();     
            $image_name = "mainImage". ".". $image -> getClientOriginalExtension();

            self::saveImage($image, $p -> id, $image_name);
        }
        $p->image = $image_name ?? '';
        $p->save();
       
        if(!blank($r -> additional_images)){//** si existen imagenes extra se guardan
            $counter = 100;
            foreach($r -> additional_images as $image){
                $image_name = $counter . ".". $image -> getClientOriginalExtension();

                $newImage = new Imagenes();
                $newImage->producto_id = $p->id;
                $newImage->image = $image_name;
                $newImage->save();

                self::saveImage($image, $p->id, $image_name);    
                $counter = $counter + 1;     
            }
        }
        if($r->items!=null){
            foreach($r->items as $item){    //** se guardan los campos del producto
                if($item['value']!='<p><br></p>'){
                    $itemProducto = new ItemsProductos();
                    $itemProducto->productos_id = $p->id;
                    $itemProducto->value = self::cleanDataEntry($item['value']) ?? '-';
                    $itemProducto->items_id = $item['id'];
                    $itemProducto->save();
                }
            }
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
        $mainImage = Storage::url("$producto->id/mini_$producto->image");
        $additionalImagesUrls = Imagenes::Where("producto_id", "=", $id)
            ->select("image")
            ->orderBy("image")
            ->get();
        $images=[];
        foreach($additionalImagesUrls as $image){
            array_push($images, Storage::url("$producto->id/$image->image"));
        }
        return view('productos.form', compact('producto', 'categorias', 'items', 'mainImage', 'opciones', 'additionalImagesUrls', 'images'));
    }

    public function update(Request $r, $id) {   //** Actualiza objetos ya existentes
        $p = Productos::find($id);
        $p->name = self::cleanDataEntry($r->name);
        $p->categoria_id = $r->categoria_id;

        if(!blank($r->file('image'))){  
            $deleteImage = $p->image;   //** Si hay nueva imgaen principal borrar antigüa y guarda la nueva
            Storage::delete("public/" . $id . "/" . $deleteImage);
            Storage::delete("public/" . $id . "/mini_" . $deleteImage);

            $image = $r->file('image');
            $image_name = "mainImage". ".". $image -> getClientOriginalExtension();

            self::saveImage($image, $p->id, $image_name);

            $p->image = $image_name;
        }

        $deleteImages = Imagenes::Where("producto_id", "=", $id)
            ->orderBy("image")
            ->get();

        foreach($deleteImages as $img){
            
            Storage::delete("public/" . $img->producto_id . "/" . $img->image);
            Storage::delete("public/" . $img->producto_id . "/mini_" . $img->image);
            $img->delete();
        }

        if(!blank($r -> additional_images)){//** si existen imagenes extra se guardan
            $counter = 100;
            foreach($r -> additional_images as $image){
                $image_name = $counter . ".". $image -> getClientOriginalExtension();

                $newImage = new Imagenes();
                $newImage->producto_id = $p->id;
                $newImage->image = $image_name;
                $newImage->save();

                self::saveImage($image, $p->id, $image_name);    
                $counter = $counter + 1;     
            }
        }

        foreach($r->items as $item){ 
            $itemProducto = ItemsProductos::where('items_id', $item['id'])->where('productos_id', $id)->first() ?? new ItemsProductos(); //** primero busca si existe el items_producto, si no existe crea uno nuevo
            
            if(!blank($itemProducto)){
                if($item['value']=='<p><br></p>'){
                    $itemProducto -> delete();
                }else{
                    $itemProducto->productos_id = $id;
                    $itemProducto->value = self::cleanDataEntry($item['value']) ?? '-';
                    $itemProducto->items_id = $item['id'];
                    $itemProducto->save();
                }
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
        if($r->textoBusqueda == trim('') && $r -> idCategoria == null) {
            return self::index();
        } 
        $productosList = Productos::busquedaProductos($r->idCategoria, $r->textoBusqueda, $r->page);
        return view('productos.all', ['textoBusqueda'=> $r->textoBusqueda, 'productosList'=>$productosList, 'categorias'=>$categorias, 'idCategoria' => $r->idCategoria]);
    }
}
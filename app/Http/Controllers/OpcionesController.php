<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Opciones;

class OpcionesController extends Controller
{

    public function __construct() {
        $this->middleware("auth");
    }
    
    public function index() {
        $opcionesList = Opciones::orderBy('key')->get();
        return view('opciones.all', ['opcionesList'=>$opcionesList]);
    }

    public function show($id) {
        $p = Opciones::find($id);
        $data['opciones'] = $p;
        return view('opciones.show', $data);
    }

    public function create() {
        return view('opciones.form');
    }

    public function store(Request $r) {
        $p = new Opciones();
        $p->value = $r->value;
        $p->key = $r->key;
        $p->type = $r->type;
        $p->save();
        if ($p->type == 'image' || $p->type=='color')
            return redirect()->route('opciones.edit', $p->id);
        else
            return redirect()->route('opciones.index');
    }

    public function edit($id) {
        $opcion = Opciones::find($id);
        $opciones = Opciones::convertToArray();
        return view('opciones.form', array('opcion' => $opcion, 'opciones' => $opciones));
    }

    public function update($id, Request $r) {
        $opcion = Opciones::find($id);
        if($opcion->type == 'image' && !blank($r->file('image'))){
            Storage::delete("public/images/" . $opcion->value );
            $image = $r->file('image');
            $image_name = $image->getClientOriginalName();
            $image->storeAs("public/images/", $image_name);
            $opcion->value = $image_name;
        }
        elseif($opcion->type == 'color'){
            $opcion->value = $r->value;
        }
        else $opcion->value = $r->value;
        $opcion->save();
        return redirect()->route('opciones.index');
    }

    public function destroy($id) {
        $p = Opciones::find($id);
        $p->delete();
        return redirect()->route('opciones.index');
    }
}
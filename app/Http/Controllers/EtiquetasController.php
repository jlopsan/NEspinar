<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Etiquetas;

class EtiquetasController extends Controller
{

    public function __construct() {
        $this->middleware("auth");
    }

    public function index() {
        $etiquetasList = Etiquetas::all();
        return view('etiquetas.all', ['etiquetasList'=>$etiquetasList]);
    }

    public function show($id) {
        $p = Etiquetas::find($id);
        $data['etiquetas'] = $p;
        return view('etiquetas.show', $data);
    }

    public function create() {
        return view('etiquetas.form');
    }

    public function store(Request $r) {
        $p = new Etiquetas();
        $p->name = $r->name;
        $p->save();
        return redirect()->route('etiquetas.index');
    }

    public function edit($id) {
        $etiquetas = Etiquetas::find($id);
        return view('etiquetas.form', array('etiqueta' => $etiquetas));
    }

    public function update($id, Request $r) {
        $p = Etiquetas::find($id);
        $p->name = $r->name;
        $p->save();
        return redirect()->route('etiquetas.index');
    }

    public function destroy($id) {
        $p = Etiquetas::find($id);
        $p->delete();
        return redirect()->route('etiquetas.index');
    }
}
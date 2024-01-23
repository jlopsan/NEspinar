@extends("layouts.master")

@section("title", "Inserción de etiquetas")

@section("header", "Inserción de etiquetas")

@section("content")
    @isset($etiqueta)
        <form action="{{ route('etiquetas.update', ['etiqueta' => $etiqueta->id]) }}" method="POST">
        @method("PUT")
    @else
        <form action="{{ route('etiquetas.store') }}" method="POST">
    @endisset
        @csrf
        <div class="container-fluid">
            Nombre de la etiqueta:<input class="form-control" type="text" name="name" value="{{$etiqueta->name ?? '' }}"><br>
            <input class="btn btn-dark center" type="submit" value="Enviar">    
        </div>
        </form>
@endsection
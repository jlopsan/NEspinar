@extends("layouts.master")

@section("title", "Inserción de items")

@section("header", "Inserción de items")

@section("content")
    @isset($item)
        <form action="{{ route('items.update', ['item' => $item->id]) }}" method="POST">
        @method("PUT")
    @else
        <form action="{{ route('items.store') }}" method="POST">
    @endisset
        @csrf
        <div class="container-fluid">
        Campo:<input class="form-control" type="text" name="name" value="{{$item->name ?? '' }}"><br>
        Categorias:<select class="form-select" type="text" name="categoria_id">

        @foreach ($categoriasList as $categoria) {
            <option value='{{$categoria->id}}'>{{$categoria->name}}</option>
        @endforeach
        <input class="btn btn-dark center mt-3" type="submit" value="Enviar">
        </div>
        </form>
@endsection
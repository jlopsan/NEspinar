@extends("layouts.master")

@section("title", "Inserción de imágenes")

@section("header", "Inserción de imágenes")

@section("content")
    @isset($imagene)
        <form action="{{ route('imagenes.update', ['imagene' => $imagene->id]) }}" method="POST">
        @method("PUT")
    @else
        <form action="{{ route('imagenes.store') }}" method="POST" enctype="multipart/form-data">
    @endisset
        @csrf
        <div class="container-fluid">
        Nombre imagen:<input class="form-control" type="file" name="image" accept="image/*" value="{{$imagene->image ?? '' }}">
        Producto:<select class="form-select" type="text" name="producto_id" id="producto_id" onchange="actualizar_items()">

        @foreach ($productosList as $producto) {
                <option value='{{$producto->id}}'>{{$producto->name}}</option>
            @endforeach

        </select>
        <input class="btn btn-dark center mt-3" type="submit" value="Enviar">
        </div>
        </form>
@endsection

<script>
    function actualizar_items() {
        id_producto = document.getElementById("producto_id").value;

        //let lista_items = null;
        fetch("/producto/get_items/" + id_producto).then(data=> data.json()).then(json=> {        
                /*let lista_items = */
                console.log(json);
                json.forEach(item => {
                    formulario.append("<input class='form-control' type='text' name='"+item.name+"'>" );
                    console.log(item);
                });
            })
        }      
</script>
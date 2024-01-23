@extends("layouts.master")

@section("title", "Administración de productos")

@section("header", "Administración de productos")

@section("content")

@auth

<table class="table table-hover">
    <tr>
        <th scope="col">Nombre
        </th>
        </th>
        <th scope="col">Foto Principal
        </th>
        <th scope="col">Colección
        </th>

        <!-- Buscador -->
        <th scope="col" colspan="2">
        @section('buscador')
            <form class="ms-auto pt-3   " action="{{route('buscadorBack')}}" method="GET">
                <div class="d-flex ">
                
                    <!-- @csrf -->
                    <div class="input-group p-3">
                    <select class="form-select" name='idCategoria'>
                        <option value=''>Selecciona una colección</option>
                        @foreach ($categorias as $categoria)
                        <option value='{{$categoria->id}}' @if(isset($idCategoria) && $idCategoria == $categoria->id) selected @endif>{{$categoria->name}}</option>
                
                        </option>
                        @endforeach
                    </select>
                            <input type="text" class="form-control" id="texto" name="textoBusqueda"
                                placeholder="Buscar objetos" value="{{isset($textoBusqueda) ? $textoBusqueda : ''}}">
                            <button class="btn btn-secondary" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </div>
            </form>
        @endsection
            <!-- Fin Buscador -->
        </th>
        <th scope="col">
            <div class="align-left">
                <a class="btn btn-outline-success" href="{{ route('productos.create') }}">Nuevo</a>
            </div>
        </th>
    </tr>
    @if (count($productosList) == 0)
    <tr>
        <td colspan="6">No hay datos para mostrar</td>
    </tr>
    @endif
    @foreach ($productosList as $producto)
    <tr>
        <td>{{$producto->name}}</td>
        <td><img src='{{asset("storage/$producto->id/mini_$producto->image")}}' width="120"></td>
        <td>{{$producto->categoria->name}}</td>
        <td>
            <a class="btn btn-outline-secondary" href="{{route('productos.edit', $producto->id)}}"><i class="fa-solid fa-pen"></i></a>
        </td>
        <td>
            <a class="btn btn-outline-secondary" href="{{route('productos.show', $producto->id)}}"><i class="fa-solid fa-eye"></i></a>
        </td>
        <td>
            <form action="{{route('productos.destroy', $producto->id)}}" method="POST">
                @csrf
                @method("DELETE")
                <button class="btn btn-outline-danger" type="submit" onclick='destroy(event)'><i class="fa-solid fa-trash-can"></i></button>
            </form>
        </td>
        @endforeach
</table>

<div class="d-flex justify-content-center">
{!! $productosList->links() !!} <!--Que genere con get -->
</div>

@endauth

@endsection

<script type="text/javascript">
function destroy(e) {
    if (!confirm('¿Seguro que desea borrar este recurso?')) {
        e.preventDefault();
    }

}
</script>

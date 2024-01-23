@extends("layouts.master")

@section("title", "Administración de imágenes")

@section("header", "Administración de imágenes")

@section("content")
    
<table class="table table-hover">
    <tr>
      <th scope="col">Imagen</th>
      <th scope="col"></th>
      <th scope="col">Producto</th>
      <th scope="col"></th> 
      <th scope="col">
        <div class ="align-left">
          <a class ="btn btn-outline-success" href="{{ route('imagenes.create') }}">Nuevo</a>
        </div>
      </th> 
    </tr>
    @foreach ($imagenesList as $imagene)
        <tr>
          <td>{{$imagene->image}}</td>
          <td>
            <img src='{{asset("storage/$imagene->producto_id/mini_$imagene->image")}}' width="150">
          </td>


          <td>{{$imagene->producto->name}}</td>

          
          <td>
          </td>
          <td>
              <form action = "{{route('imagenes.destroy', $imagene->id)}}" method="POST">
                  @csrf
                  @method("DELETE")
                  <button class="btn btn-outline-danger" type="submit" onclick='destroy(event)'><i class="fa-solid fa-trash-can"></i></button>
              </form>
          </td>

    @endforeach
    </table>
@endsection

<script type = "text/javascript">
  function destroy(e){
    if (!confirm('¿Seguro que desea borrar este recurso?')){
    e.preventDefault();
    }

  }
  </script>
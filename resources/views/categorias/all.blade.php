@extends("layouts.master")

@section("title", "Administración de categorias")

@section("header", "Administración de categorias")

@section("content")

<table class="table table-hover">
    <tr>
      <th scope="col">Nombre</th>
      <th scope="col"></th> 
      <th scope="col">
      <th scope="col">Orden</th>  
      <th scope="col">
        <div class ="align-left">
          <a class ="btn btn-outline-success" href="{{ route('categorias.create') }}">Nuevo</a>
        </div>  
      </th> 
    </tr>
    @php
        $i = 1;
    @endphp
    @foreach ($categoriasList as $categoria)
        <tr>
            <td>{{$categoria->name}}</td>
            <td>
                <a class="btn btn-outline-secondary" href="{{route('categorias.edit', $categoria->id)}}"><i class="fa-solid fa-pen"></i></a></td>
            <td>
                <form action = "{{route('categorias.destroy', $categoria->id)}}" method="POST">
                    @csrf
                    @method("DELETE")
                    <button class="btn btn-outline-danger" type="submit" onclick='destroy(event)'><i class="fa-solid fa-trash-can"></i></button>
                </form>
            </td>
            <td>
                @if ($i == 1)
                <i class="btn btn-outline-secondary fa-solid fa-ban"></i>
                @endif
                @if ($i > 1)
                <a class="btn btn-outline-secondary" href="{{route('categorias.changeOrder', ['id' => $categoria->id, 'orden' => $categoria->order, 'cantidad' =>-1])}}"><i class="fa-solid fa-arrow-circle-up"></i></a>
                @endif
                @if ($i < count($categoriasList))
                <a class="btn btn-outline-secondary" href="{{route('categorias.changeOrder', ['id' => $categoria->id, 'orden' => $categoria->order, 'cantidad' => 1])}}"><i class="fa-solid fa-arrow-circle-down"></i></a>
                @endif
                @if ($i == count($categoriasList))
                <i class="btn btn-outline-secondary fa-solid fa-ban"></i>
                @endif
                @php
                    $i++;
                @endphp
            </td>
    @endforeach
    </table>
@endsection

<script type = "text/javascript">
  function destroy(e){
    if (!confirm('¿Seguro que desea borrar este recurso? ->IMPORTANTE<- Se borraran todos los datos que contenga esta categoria.')){
    e.preventDefault();
    }

  }
  </script>
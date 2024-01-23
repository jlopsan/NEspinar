@extends("layouts.master")

@section("title", "Administración de opciones")

@section("header", "Administración de opciones")

@section("content")
   
<table class="table table-hover">
    <tr>
      <th scope="col">Clave</th>
      <th scope="col">Valor</th> 
      <th scope="col">Tipo</th>
      <th scope="col">
        <div class ="align-left">
          <a class ="btn btn-outline-success" href="{{ route('opciones.create') }}">Nuevo</a>
        </div>
      </th> 
 
    </tr>
    @foreach ($opcionesList as $opcion)
        <tr>
            <td>{{$opcion->key}}</td>
            <td>
              @if ($opcion->type=="color")
                 <span style="background-color: {{$opcion->value}}; border: solid black 1px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
              @endif
              {{strip_tags(Str::limit($opcion->value, 100))}}
            </td>
            <td>{{$opcion->type}}</td>
            <td><a class="btn btn-outline-secondary" href="{{route('opciones.edit', $opcion->id)}}"><i class="fa-solid fa-pen"></i></a></td></td>
        </tr>    
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
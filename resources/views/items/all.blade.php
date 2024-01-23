@extends("layouts.master")

@section("title", "Administración de items")

@section("header", "Administración de items")


@section("content")
    
    <table class="table table-hover">
    <tr>
      <th scope="col">Campo</th>
      <th scope="col">Destacado</th>
      <th scope="col">Colección</th>  
      <th scope="col">Orden</th>  
      <th scope="col"></th> 
      <th scope="col">
          <div class ="align-left">
              <a class ="btn btn-outline-success" href="{{ route('items.create') }}">Nuevo</a>
          </div>
      </th> 

        <!-- Buscador -->
        <th scope="col" colspan="3">
        @section('buscador')
            <form class="ms-auto pt-3" action="{{route('buscadorBack')}}" method="GET">
                <div class="d-flex ">
                
                    <!-- @csrf -->
                    <div class="input-group p-3">
                    <select class="form-select" name='idCategoria' id='idCategoria' onChange='filtrarPorCategoria()'>
                        <option value='-1'>Selecciona una colección</option>
                        @foreach ($categorias as $categoria)
                        <option value='{{$categoria->id}}' @if(isset($idCategoria) && $idCategoria == $categoria->id) selected @endif>{{$categoria->name}}</option>
                        @endforeach
                    </select>
                    </div>
                </div>
            </form>
        @endsection
        </th>
        <!-- Fin Buscador -->
        
    </tr>
    @php
        $i = 1;
    @endphp
    @foreach ($itemsList as $item)
        <tr>
            <td>{{$item->name}}</td>
            <td>
                <!-- creamos un checkbox para el campo "destacado". Si el ítem está destacado, el check aparecerá marcado -->
                <input type="checkbox" name="destacado" value="{{$item->destacado}}" 
                       class="checkbox-destacado" id="destacado-{{$item->id}}"
                       @if ($item->destacado == 1) checked @endif
                       onchange = 'destacarItem({{$item->id}})'>
            </td>
            <td>{{$item->categoria->name}}</td>
            <td>
                @if ($i == 1)
                <i class="btn btn-outline-secondary fa-solid fa-ban"></i>
                @endif
                @if ($i > 1)
                <a class="btn btn-outline-secondary" href="{{route('items.changeOrder', ['id' => $item->id, 'orden' => $item->order, 'cantidad' =>-1])}}"><i class="fa-solid fa-arrow-circle-up"></i></a>
                @endif
                @if ($i < count($itemsList))
                <a class="btn btn-outline-secondary" href="{{route('items.changeOrder', ['id' => $item->id, 'orden' => $item->order, 'cantidad' => 1])}}"><i class="fa-solid fa-arrow-circle-down"></i></a>
                @endif
                @if ($i == count($itemsList))
                <i class="btn btn-outline-secondary fa-solid fa-ban"></i>
                @endif
                @php
                    $i++;
                @endphp
            </td>
            <td>
                <a class="btn btn-outline-secondary" href="{{route('items.edit', $item->id)}}"><i class="fa-solid fa-pen"></i></a>
            </td>
            <td>
                <form action = "{{route('items.destroy', $item->id)}}" method="POST">
                    @csrf
                    @method("DELETE")
                    <button class="btn btn-outline-danger" type="submit" onclick='destroy(event)'><i class="fa-solid fa-trash-can"></i></button>
                </form>
            </td>
          </tr>

    @endforeach
    </table>
@endsection

<script type = "text/javascript">
  function destroy(e){
      if (!confirm('¿Seguro que desea borrar este recurso? ->IMPORTANTE<- Se borraran todos los datos relacionados a este campo de los productos que lo usen.')){
      e.preventDefault();
    }
  }

  function filtrarPorCategoria() {
      var idCategoria = document.getElementById('idCategoria').value;
      window.location.href = "{{url('items/category')}}" + "/" + idCategoria;
  }


  // Cambia el valor del campo "destacado" mediante una llamada asíncrona al servidor.
  // Si el ítem estaba destacado, lo desdestaca y viceversa.
  // Solo puede haber un ítem destacado por categoría.
  function destacarItem(itemId) {
        var checked, itemDestacado;
        itemDestacado = document.getElementById("destacado-" + itemId).value;
        if (itemDestacado == 1) {
            itemDestacado = 0;
            checked = false;
        } else {
            itemDestacado = 1;
            checked = true;
        }
        // Llamada asíncrona al servidor usando fetch
        fetch("{{url('items/destacar')}}/" + itemId + "/" + itemDestacado)
        .then(function(response) {
            // si la respuesta es correcta, actualizamos el valor del checkbox
            if (response.ok == true) {
                // Eliminamos el "checked" de todos los checkboxes de la clase checbox-destacado
                var checkboxes = document.getElementsByClassName("checkbox-destacado");
                for (var i = 0; i < checkboxes.length; i++) {
                    checkboxes[i].checked = false;
                }
                // Ponemos el "checked" en el checkbox que ha sido modificado
                document.getElementById("destacado-" + itemId).checked = checked;
                document.getElementById("destacado-" + itemId).value = itemDestacado;
            } else {
                alert("No se puede conectar con el servidor. El campo no ha podido modificarse. Si el error persiste, recargue la página o contacte con su administrador de sistemas.");
            }
        })
  }
  </script>
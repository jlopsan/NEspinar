@extends('layouts.front')

@section('content')
<style>
    /* Estilos generales */
    #contenedor-todo {
        margin-bottom: 250px; /* Valor predeterminado para dispositivos móviles */
    }

    /* Estilos para dispositivos de escritorio */
    @media (min-width: 768px) {
        #contenedor-todo {
            margin-bottom: 150px; /* Valor para dispositivos de escritorio */
        }
    }
</style>
<div class="container" id="contenedor-todo">
    <div class="container" style="margin-top: 120px; padding-left: 2em; padding-right:2em; ">

    <div style="float: right;">
        <table style="font-size: 14px;">
            <tr>
                <td>Signos diacriticos:  </td>
                <td>ʿ</td><td>  </td>
                <td>’</td><td>  </td>
                <td>Ī</td><td>  </td>
                <td>Ū</td><td>  </td>
                <td>Š</td><td>  </td>
                <td>Ŷ</td><td>  </td>
                <td>Ḥ</td><td>  </td>
                <td>Ṣ</td><td>  </td>
                <td>Ḍ</td><td>  </td>
                <td>Ẓ</td><td>  </td>
                <td>Ṭ</td><td>  </td>
                <td>Ḏ</td><td>  </td>
                <td>Ṯ</td><td>  </td>
                <td>ā</td><td>  </td>
                <td>ī</td><td>  </td>
                <td>ū</td><td>  </td>
                <td>š</td><td>  </td>
                <td>ŷ</td><td>  </td>
                <td>ḥ</td><td>  </td>
                <td>ṣ</td><td>  </td>
                <td>ḍ</td><td>  </td>
                <td>ẓ</td><td>  </td>
                <td>ṭ</td><td>  </td>
                <td>ḏ</td><td>  </td>
                <td>ṯ</td><td>  </td>
            </tr>
        </table>
    </div>  

    <!-- Buscador General -->
    <div class="container" id="buscador_general_front" style="padding-bottom: 2em">
        
        <div class="informacion_busquedas" style="font-family: {{$opciones['tipografia3']}}; text-align: justify;">
            <h5>BÚSQUEDA GENERAL: <br><br></h5>

            <form action="{{route('buscadorFront')}}" method="GET" style="padding-bottom: 2em; padding-left:2em">
                <div class="input-group" style="font-family: {{$opciones['tipografia3']}}">
                    <input type="text" class="form-control" id="texto" name="textoBusqueda" placeholder="Busqueda general" value="{{isset($textoBusqueda) ? $textoBusqueda : ''}}">
                    <button class="btn btn-dark" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div> 
            </form>
            <p style="padding-left: 2em;">
                El buscador general realiza una búsqueda en todos los campos de todas las categorías y el nombre de los objetos. El resultado de la búsqueda es una aproximación, lo que significa que mostrará los objetos que contengan de alguna manera alguna de las palabras ingresadas en el campo de búsqueda.<br>
                
                Para buscar coincidencias exactas, puedes utilizar comillas "". Por ejemplo, si buscas "hola pepe 33" entre comillas, el buscador mostrará los objetos que contengan esa combinación de palabras.<br> 
            </p>
        </div>
    </div>
    <!-- Fin Buscador General -->
    </div>
    <p>_____________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________</p>
    <!-- Checkbox categorias -->
        
    <div class="container" id="buscador_por_campos" style=" padding-left:2em;">
    <div class="informacion_busquedas" style="font-family: {{$opciones['tipografia3']}}; text-align: justify;">
        <h5>BÚSQUEDA POR CAMPOS: <br></h5>
        <p style="padding-left: 2em;">
            El buscador por campos realizará la búsqueda en el/los campo/s deseado/s de la categoría seleccionada (casillas redondas).<br>
            El buscador por campos funciona de manera similar al buscador general, pero con una diferencia importante: si no hay coincidencias en todos los campos rellenados, el objeto no aparecerá en los resultados.            
        </P>
    </div>

        <form action="{{route('buscadorPorCampos')}}" method="POST" id="formBusqueda" style="font-family: {{$opciones['tipografia3']}}">
            
            @csrf

            @foreach ($categoriasList as $key => $categoria)
                <label class="form-check-label mb-1  mt-2">
                    <input {{ $key == 0 ? 'checked' : '' }} class="form-check-input" type="radio" id="categoria{{$key}}" name="categoria_id" onclick="showItems(this)" value="{{$categoria->id}}">
                    {{$categoria->name}}
                </label> 
            @endforeach
            <!-- Fin Checkbox categorias -->
            
            <!-- Buscador por campos -->
            <div class="d-flex" style="text-align:left">
                @foreach ($categoriasList as $key => $categoria)
                    <div class="{{ $key != 0 ? 'd-none' : '' }} items categoria{{$key}} ">
                        @foreach($categoria->items as $item)
                            <label class="col-md-4" style="margin-right:7%">
                                {{$item->name}}
                                <input class="form-control" type="text" name="items[{{$item->id}}][texto]">
                                <input type="hidden" name="items[{{$item->id}}][categoria_id]" value="{{$item->categoria->id}}">
                                <input type="hidden" name="items[{{$item->id}}][item_id]" value="{{$item->id}}">
                            </label>
                        @endforeach
                    </div>
                @endforeach
            </div>
            <!-- Fin Buscador por campos -->
            <p class="text-danger" id="sendError"></p>

            <button id="botonBusquedaCampos" class="btn btn-dark" type="submit">
                Buscar &nbsp;&nbsp;&nbsp;<i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>
    </div>
    </div>
</div>


<script>
    // Función para mostrar los items según la categoría seleccionada
    function showItems(element) {
        document.querySelectorAll('.items').forEach((el) => {
            el.classList.add('d-none');
        });
        document.querySelector("." + element.id).classList.remove('d-none');
    }

    // Validación para enviar el formulario de búsqueda por campos
    const botonBusquedaCampos = document.getElementById('botonBusquedaCampos');
    const form = document.getElementById('formBusqueda');
    botonBusquedaCampos.addEventListener('click',(event) => {
        let sendForm = false;
        form.querySelectorAll('input[name^="items"]').forEach((el) => {
            if (el.value != '') sendForm = true;
        });
        if (!sendForm) {
            event.preventDefault();
            document.getElementById('sendError').innerHTML = 'Tienes que rellenar al menos un campo';
        } 
    });
</script>

@endsection
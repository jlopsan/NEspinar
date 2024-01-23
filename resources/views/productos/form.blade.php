@extends("layouts.master")

@section("title", "Modificación de productos")

@section("header", "Modificación de productos")

@section("content")

@isset($producto)
<!-- CASO 1: Vamos a hacer update de un producto que ya existe -->
<form action="{{ route('productos.update', ['producto' => $producto->id]) }}" method="POST" id="formulario" enctype="multipart/form-data">
    <div class="container-fluid" id="miFormulario">
        <!-- @foreach ($producto->items as $item) 
                    {{$item->name}} <input class="form-control" type="text" value='{{$item->pivot->value}}'><br>
                    @endforeach -->
    </div>
    <script>
        var editor = []; // Array de editores de texto wysiwyg (habrá que crear uno por cada ítem)
    </script>
    @method("PUT")
@else
<!-- CASO 2: Vamos a hacer insert de un producto nuevo -->
    <form action="{{ route('productos.store') }}" method="POST" id="formulario" enctype="multipart/form-data">
@endisset

        @csrf
        <div class="container-fluid" id="miFormulario">
            Categoria:<select class="form-select" type="text" name="categoria_id" id="categoria_id" onchange="actualizar_items()">
                <option value=''>Selecciona</option>
                @foreach ($categorias as $categoria) {
                <option value='{{$categoria->id}}' @if(isset($producto->categoria) && $producto->categoria->id ==
                    $categoria->id) selected @endif>{{$categoria->name}}</option>}
                @endforeach
            </select> <br>
            Nombre :<input required class="form-control" type="text" name="name" value="{{$producto->name ?? '' }}" id="categoria_id"><br>
            Foto principal:
            @if(isset($image))
            <div id="image">
                <img src="{{$image}}" width=150>
            </div> <br>
            @endif
            <input class="form-control" type="file" accept="image/*" name="image" value="{{$producto->image ?? '' }}"><br>

            <div id="image" class="row">
                @if (isset($producto))
                @foreach($producto->imagenes as $image)
                <div class="image-item d-flex justify-content-center align-items-center col-sm-2" onclick="deleteItem(this)">
                    <img src="/storage/{{$producto->id}}/mini_{{$image->image}}" width="150">
                    <input value="{{$image->image}}" class="inputDelete" name="images[]" type="hidden">
                    <i class="fa-solid fa-trash fs-1 btnDelete"></i>
                </div>
                @endforeach
                @endif
                <div id="deleteImages">
                </div>
            </div> <br>

            Fotos Adicionales:
            <input class="form-control" type="file" accept="image/*" name="images[]" multiple value="">


            <div id="listItems">
                @if(isset($items))
                    <!-- CASO 1: Vamos a hacer update de un producto que ya existe, y por lo tanto ya tiene valor en sus ítems.
                        Vamos a mostrar esos items en editores wysiwyg -->
                    @foreach($items as $key => $item)
                        <label class="mt-4">{{$item->name}}</label>
                        @if ($opciones["texto_enriquecido"] == 1)
                            <textarea name="items[{{$key}}][value]" id="textarea-{{$item->id}}" class="form-control">
                                {{$item->itemsProducto->value ?? ''}}
                            </textarea>
                            <input type="hidden" name="items[{{$key}}][id]" value="{{$item->id ?? '' }}">
                            <script>
                                // Este script asigna un editor wysiwyg a cada textarea
                                editor[{{$item->id}}] = SUNEDITOR.create((document.getElementById("textarea-{{$item->id}}") || "textarea-{{$item->id}}"), {
                                    lang: SUNEDITOR_LANG['es']
                                });
                            </script>
                        @else
                            <input class="form-control" type="text" name="items[{{$key}}][value]"
                                    value="{{$item->itemsProducto->value ?? '' }}">
                            <input type="hidden" name="items[{{$key}}][id]" value="{{$item->id ?? '' }}">   
                        @endif                     
                    @endforeach
                    @if ($opciones["texto_enriquecido"] == 1)
                    <script>
                        // Hacemos que con el submit se guarde el contenido de todos los editores de texto wysiwyg que hemos creado
                        document.querySelector('form').addEventListener('submit', function() {
                            @foreach($items as $key => $item)
                                editor[{{$item->id}}].save();
                            @endforeach
                        });
                    </script>
                    @endif
                @endif
            </div>
            @if (isset($producto))
                <input class="btn btn-dark center mt-3" type="submit" value="Enviar" id="submitButton">
            @else
                <input class="btn btn-dark center mt-3" type="submit" value="Enviar" id="submitButton" disabled>
            @endif
        </div>
    </form>
    @endsection

    <script>
        var editor = []; // Creamos un array para guardar los editores de texto wysiwyg

        // Esta función se ejecuta cuando se selecciona una categoría. Carga de forma asíncrona todos los ítems de 
        // esa categoría y los muestra como textareas en el formulario.
        function actualizar_items() {
            id_categoria = document.getElementById("categoria_id").value;
            var listItems = document.getElementById("listItems");
            listItems.innerHTML = "";
            var cont = 0;
            fetch("/categorias/get_items/" + id_categoria).then(data => data.json()).then(json => {
                json.forEach(item => {
                    var hidden = document.createElement("input");
                    var label = document.createElement("label");
                    @if ($opciones["texto_enriquecido"] == 0)
                        var input = document.createElement("input");
                        input.type = "text";
                        input.name = `items[${cont}][value]`;
                        input.classList.add("form-control");
                    @else
                        var textarea = document.createElement("textarea");
                        textarea.name = `items[${cont}][value]`;
                        textarea.id = 'textarea-' + item.id;
                        textarea.classList.add("form-control");
                    @endif
                    hidden.type = "hidden";
                    hidden.name = `items[${cont}][id]`;
                    hidden.value = item.id;
                    label.innerHTML = item.name;
                    label.classList.add("mt-4");
                    listItems.appendChild(label);
                    listItems.appendChild(hidden);
                    @if ($opciones["texto_enriquecido"] == 0)
                        listItems.appendChild(input);
                    @else
                        listItems.appendChild(textarea);
                    @endif
                    // Carga Suneditor (editor Wysiswyg) en el textarea recién creado

                    @if ($opciones["texto_enriquecido"] == 1)
                        editor[cont] = SUNEDITOR.create((document.getElementById(textarea.id) || textarea.id), {
                            lang: SUNEDITOR_LANG['es']
                        });
                    @endif
                    cont++;
                });
                // Hacemos que con el submit se guarde el contenido de todos los editores de texto wysiwyg
                @if ($opciones["texto_enriquecido"] == 1)
                    document.querySelector('form').addEventListener('submit', function() {
                        for ($i = 0; $i < cont; $i++) {
                            editor[$i].save();
                        }
                    });
                @endif
            })
            activar_btn();
        }

        function deleteItem(este) {
            let inputValue = este.querySelector('.inputDelete').value
            if (confirm(`¿Desea borrar el archivo ${inputValue}?`)) {
                document.getElementById('deleteImages').innerHTML +=
                    `<input type="hidden" name="deleteImages[]" value="${inputValue}">`
                este.remove()
            }
        }

        function activar_btn() {
            // Desactiva el botón de enviar hasta que se selecciona una categoría
            if (document.getElementById("categoria_id").value !== "") {
                document.getElementById("submitButton").disabled = false;
            } else {
                document.getElementById("submitButton").disabled = true;
            }
        }
    </script>



    <!-- Carga Suneditor: editor de texto Wysisyg -->

    <link href="https://cdn.jsdelivr.net/npm/suneditor@latest/dist/css/suneditor.min.css" rel="stylesheet">
    <!-- <link href="https://cdn.jsdelivr.net/npm/suneditor@latest/assets/css/suneditor.css" rel="stylesheet"> -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/suneditor@latest/assets/css/suneditor-contents.css" rel="stylesheet"> -->
    <script src="https://cdn.jsdelivr.net/npm/suneditor@latest/dist/suneditor.min.js"></script>
    <!-- languages (Basic Language: English/en) -->
    <script src="https://cdn.jsdelivr.net/npm/suneditor@latest/src/lang/ko.js"></script>
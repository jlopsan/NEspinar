@extends("layouts.master")

@section("title", "Modificación de productos")

@section("header", "Modificación de productos")

@section("content")

<style>
    .imagen-ordenar{
        width: 150px;
        height: 150px;
        object-fit: contain;
        display: flex !important;
        justify-content: center;
        align-items: center;
        border-radius: 8px;
	    border: 1px dashed #609dd6;
    }

    #additional-images div div img {
        max-width: 100%;
        max-height: 100%;
    }
</style>

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
    <form action="{{ route('productos.store') }}" method="POST" id="formulario" enctype="multipart/form-data"">
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


            Fotos Adicionales:
{{--             <input class="form-control" type="file" accept="image/*" name="images[]" oninput="" value="">

            <!-- Campo para la imagen principal -->
            <input class="form-control" type="file" accept="image/*" name="image" value="{{ $producto->image ?? '' }}"><br> --}}

            <div id="additional-images" style="display: flex; flex-wrap: wrap;">

            </div>

            <button type="button" onclick="agregarImagen()">Agregar imagen</button>

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
        document.addEventListener('DOMContentLoaded', function() {
            downloadImages(@json($images))
            .then(images => {
                console.log('Imágenes descargadas:', images);
                images.forEach(function(image){
                    agregarImagen(image);
                    console.log(image);
                });
            })
            .catch(error => {
                console.error('Error al descargar las imágenes:', error);
            });
        });

        async function downloadImages(urls) {
            const images = [];

            console.log(urls);

            // Iterar sobre cada URL en el array
            for (const url of urls) {
                // Hacer una solicitud para descargar la imagen
                const response = await fetch(url);
                const blob = await response.blob();

                // Crear un objeto File a partir de la imagen descargada
                const filename = url.substring(url.lastIndexOf('/') + 1);
                const file = new File([blob], filename, { type: blob.type });

                // Agregar el archivo al array de imágenes descargadas
                images.push(file);
            }

            // Retornar el array de imágenes descargadas
            return images;
        } 

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

        // Función para agregar una nueva entrada de imagen al formulario
        function agregarImagen(file=null) {
            var container = document.getElementById('additional-images');
            var input = document.createElement('input');
            input.type = 'file';
            input.accept = 'image/*';
            input.name = 'additional_images[]'; // Cambia esto según tu controlador de Laravel

            // Contenedor para la vista previa de la imagen
            var previewContainer = document.createElement('div');
            previewContainer.style.marginBottom = '10px'; // Ajusta el margen inferior del contenedor de vista previa
            previewContainer.classList.add('imagen-ordenar');

            function previewImage(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        var img = document.createElement('img');
                        img.src = e.target.result;
                        img.style.maxWidth = '100%'; // Ajustar el tamaño máximo de la imagen
                        previewContainer.innerHTML = ''; // Limpiar la vista previa antes de agregar una nueva imagen
                        previewContainer.appendChild(img);
                        previewContainer.style.display = 'block'; // Mostrar la vista previa de la imagen
                        input.style.display = 'none'; // Ocultar el campo de entrada de la imagen
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }

            // Función para mostrar la vista previa de la imagen seleccionada
            input.addEventListener('change', function(event){
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        var img = document.createElement('img');
                        img.src = e.target.result;
                        img.style.maxWidth = '100%'; // Ajustar el tamaño máximo de la imagen
                        previewContainer.innerHTML = ''; // Limpiar la vista previa antes de agregar una nueva imagen
                        previewContainer.appendChild(img);
                        previewContainer.style.display = 'block'; // Mostrar la vista previa de la imagen
                        input.style.display = 'none'; // Ocultar el campo de entrada de la imagen
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            });

            // Función para volver a mostrar el campo de entrada de la imagen al hacer clic en la vista previa
            previewContainer.addEventListener('click', function() {
                previewContainer.style.display = 'none'; // Ocultar la vista previa de la imagen
                input.style.display = 'block'; // Mostrar el campo de entrada de la imagen
                input.value = ''; // Restablecer el valor del campo de entrada para permitir la selección de una nueva imagen
            });

            // Botones de flechas para reordenar
            var leftButton = document.createElement('button');
            leftButton.type = 'button'; // Especificar tipo de botón
            leftButton.textContent = '←';
            leftButton.onclick = function() {
                moverImagen(input, -1);
            };
            var rightButton = document.createElement('button');
            rightButton.type = 'button'; // Especificar tipo de botón
            rightButton.textContent = '→';
            rightButton.onclick = function() {
                moverImagen(input, 1);
            };

            // Contenedor para los botones de flechas
            var buttonContainer = document.createElement('div');
            buttonContainer.style.display = 'flex';
            buttonContainer.appendChild(leftButton);
            buttonContainer.appendChild(rightButton);

            // Contenedor para la imagen y los botones de flechas
            var imageContainer = document.createElement('div');
            imageContainer.style.display = 'flex';
            imageContainer.style.flexDirection = 'column'; // Alinear elementos verticalmente
            imageContainer.appendChild(input);
            imageContainer.appendChild(previewContainer); // Agregar la vista previa de la imagen
            imageContainer.appendChild(buttonContainer);

            container.appendChild(imageContainer);

            if(file){
                const fileList = new DataTransfer();
                fileList.items.add(file);
                input.files = fileList.files;
                previewImage(input);
            }
        }


        // Función para reordenar una imagen
        function moverImagen(input, delta) {
            var container = input.parentNode.parentNode;
            var index = Array.prototype.indexOf.call(container.children, input.parentNode);

            if (delta < 0 && index > 0) {
                container.insertBefore(container.children[index], container.children[index - 1]);
            } else if (delta > 0 && index < container.children.length - 1) {
                container.insertBefore(container.children[index + 1], container.children[index]);
            }
        }

        // Función para activar el botón de envío cuando se selecciona al menos una categoría
        function activar_btn() {
            var submitButton = document.getElementById('submitButton');
            var categoria_id = document.getElementById('categoria_id').value;
            if (categoria_id !== "") {
                submitButton.disabled = false;
            } else {
                submitButton.disabled = true;
            }
        }

        /* // Llama a la función de activación del botón cuando se selecciona una categoría
        document.getElementById('categoria_id').addEventListener('change', activar_btn); */

        function mostrarVistaPrevia(event) {
        var input = event.target;
        
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
                var previewContainer = document.getElementById('preview-container');
                previewContainer.innerHTML = ''; // Limpiar la vista previa antes de agregar una nueva imagen
                
                var img = document.createElement('img');
                img.src = e.target.result;
                img.style.maxWidth = '100%'; // Ajustar el tamaño máximo de la imagen
                previewContainer.appendChild(img);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Función para reordenar una imagen
    function moverImagen(input, delta) {
        var container = input.parentNode.parentNode;
        var index = Array.prototype.indexOf.call(container.children, input.parentNode);

        if (delta < 0 && index > 0) {
            container.insertBefore(container.children[index], container.children[index - 1]);
        } else if (delta > 0 && index < container.children.length - 1) {
            container.insertBefore(container.children[index + 1], container.children[index]);
        }

        // Actualizar el valor de los inputHidden con los nuevos IDs de imagen
        actualizarIdsImagenes(container);
    }

    // Función para actualizar los IDs de las imágenes después de reordenarlas
    function actualizarIdsImagenes(container) {
        var images = container.querySelectorAll('input[type="file"]');
        images.forEach(function(image, index) {
            var newId = 'image_' + index;
            image.id = newId;
            // Actualizar el valor de los inputHidden
            var hiddenInput = image.nextElementSibling; // Obtener el siguiente elemento que es el inputHidden
            hiddenInput.value = newId;
        });
    }
    

    </script>



    <!-- Carga Suneditor: editor de texto Wysisyg -->

    <link href="https://cdn.jsdelivr.net/npm/suneditor@latest/dist/css/suneditor.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/suneditor@latest/dist/suneditor.min.js"></script>
    <!-- languages (Basic Language: English/en) -->
    <script src="https://cdn.jsdelivr.net/npm/suneditor@latest/src/lang/ko.js"></script>
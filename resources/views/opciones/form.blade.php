@extends("layouts.master")


@section("title", "Inserción de opciones")

@section("header", "Inserción de opciones")

@section("content")
    @isset($opcion)
        <form action="{{ route('opciones.update', ['opcione' => $opcion->id]) }}" method="POST" enctype="multipart/form-data">
        @method("PUT")
            @csrf
            <div class="container-fluid">
                <label class="control-label w-100 mt-2">Clave:</label>
                <input class="form-control mt-2"  type="text" name="key" disabled value="{{$opcion->key ?? '' }}"> <!--Si se pone disabled en el input no se modifiquen los valores -->
                <label class="control-label w-100 mt-2">Tipo:</label>
                <input class="form-control mt-2"  type="text" name="type" disabled value="{{$opcion->type ?? '' }}">
                @if($opcion->type == 'image')
                    <!-- Opción de tipo "image" -->
                    <label class="control-label w-100 mt-2">Foto:</label>
                    <img class="mt-2" src="/storage/images/{{$opcion->value}}" width=200 /><br>
                    <input class="form-control mt-2" type="file" accept="image/*" name="image" value="">
                @elseif($opcion->type == 'color')
                <!-- Opción de tipo "color" -->
                    <label class="control-label w-100 mt-2">Valor:</label>
                    <input class="form-control mt-2" id="value" type="text" name="value" value="{{$opcion->value ?? '' }}">
                    <label class="control-label w-100 mt-2">Color:</label>
                    <input type="color" id="color" onChange="actualizarColor()" name="color" value="{{$opcion->value}}">
                @elseif($opcion->type == 'font')
                <!-- Opción de tipo "font" -->
                    <label class="control-label w-100 mt-2" style="font-family: Montserrat">Valor:</label>
                    <!-- Lista de fuentes de Google fonts que se pueden usar -->
                    @php
                    // Convertimos la cadena en un array separándola por los saltos de línea
                    $fonts = explode(PHP_EOL, $opciones['tipografias_disponibles']);
                    sort($fonts);
                    @endphp

                    @foreach ($fonts as $font)
                    <link href="https://fonts.googleapis.com/css?family={{$font}}" rel="stylesheet">
                    @endforeach
                    <div class="form-control mt-2"> 
                    <select name="value" id="value" onChange="actualizarTextoEjemplo()">
                        @foreach ($fonts as $font)
                            <option value="{{$font}}" id="font_{{$font}}" 
                            style="font-family: {{$font}}" @if($opcion->value == $font) selected @endif>{{$font}}</option>
                        @endforeach
                    </select>
                    </div>
                    <div class="form-control" id="textoEjemplo" style="font-family: {{$opcion->value}}; font-size: 140%">Así se verá el texto con la fuente {{$opcion->value}}</div>
                @elseif($opcion->type == 'longText')
                <!-- Opción de tipo "longText" -->
                    <label class="control-label w-100 mt-2">Texto:</label>
                    <textarea name="value" id="valueTextarea" cols="100" rows="20">{{$opcion->value}}</textarea>
                @else
                <!-- Opción de otro tipo ("text" o "number", se tratan igual, como input de tipo text) -->
                    <label class="control-label w-100 mt-2">Valor:</label>
                    <input class="form-control mt-2" id="value" type="text" name="value" value="{{$opcion->value ?? '' }}">
                @endif
                <input class="btn btn-dark center mt-2" type="submit" value="Enviar">
            </div>
        </form>
        @else

        <form action="{{ route('opciones.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="container-fluid">
                <label class="control-label w-100 mt-2">Clave:</label>
                <input class="form-control mt-2"  type="text" name="key" >
                <label class="control-label w-100 mt-2">Tipo:</label>
                <select class="form-control mt-2" name="type">
                    <option value="number">Número (number)</option>
                    <option value="text">Texto (text)</option>
                    <option value="longText">Texto largo (longText)</option>
                    <option value="font">Fuente (font)</option>
                    <option value="color">Color (color)</option>
                    <option value="image">Imagen (image)</option>
                </select>
                <label class="control-label w-100 mt-2">Valor:</label>
                <input class="form-control mt-2" type="text" name="value">
                <input class="btn btn-dark center mt-2" type="submit" value="Enviar">
            </div>
        </form>
        @endisset

        <script>
            function actualizarColor(){
                color=document.getElementById("color").value;
                document.getElementById("value").value = color;
            }
            function actualizarTextoEjemplo(){
                font = document.getElementById("value").value;
                document.getElementById("textoEjemplo").innerHTML = "Así se verá el texto con la fuente " + font;
                document.getElementById("textoEjemplo").style.fontFamily = font;
            }
        </script>

<!-- Carga Suneditor: editor de texto Wysisyg -->
<link href="https://cdn.jsdelivr.net/npm/suneditor@latest/dist/css/suneditor.min.css" rel="stylesheet">
<!-- <link href="https://cdn.jsdelivr.net/npm/suneditor@latest/assets/css/suneditor.css" rel="stylesheet"> -->
<!-- <link href="https://cdn.jsdelivr.net/npm/suneditor@latest/assets/css/suneditor-contents.css" rel="stylesheet"> -->
<script src="https://cdn.jsdelivr.net/npm/suneditor@latest/dist/suneditor.min.js"></script>
<!-- languages (Basic Language: English/en) -->
<script src="https://cdn.jsdelivr.net/npm/suneditor@latest/src/lang/ko.js"></script>

<!-- Lanza Suneditor: editor de texto Wysisyg -->
<script>
const editor = SUNEDITOR.create((document.getElementById('valueTextarea') || 'valueTextarea'),{
    // All of the plugins are loaded in the "window.SUNEDITOR" object in dist/suneditor.min.js file
    // Insert options
    // Language global object (default: en)
    lang: SUNEDITOR_LANG['es']
});
document.querySelector('form').addEventListener('submit', function() {
  editor.save();
});
</script>
@endsection

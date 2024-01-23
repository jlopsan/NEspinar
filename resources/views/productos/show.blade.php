@extends("layouts.master")
@section("title", "vista de productos")
@section("header", "vista de productos")

@section("content")
<form id="formulario">
    <div class="container-fluid">
        Categoriaaaaes qauiasdfasaaaa:<input class="form-control" type="text" disabled name="categoria_id"
            value="{{$producto->categoria->name}}" id="categoria_id"><br>
        Nombre :<input class="form-control" type="text" disabled name="name" value="{{$producto->name ?? '' }}"
            id="categoria_id"><br>

        @foreach ($producto->items as $item)
            @php
                $valorDecoded = htmlspecialchars_decode($item->pivot->value);
                $valorDecoded = str_replace('&nbsp;', ' ', $valorDecoded);
                $valorItem = $valorDecoded == "" ? "Sin Valor" : strip_tags($valorDecoded);
            @endphp
            {{$item->name}} <input class="form-control" disabled type="text" value='{{$valorItem}}'>
            <br>
        @endforeach

        Imagen: <br> <img id = "mi_imagen" src='{{asset("storage/$producto->id/$producto->image")}}' width="150">
        @foreach($producto->imagenes as $image)
        <img src='{{asset("storage/$producto->id/$image->image")}}' width="150">
        @endforeach
    </div>
</form>
<div class="d-grid gap-4 d-md-flex justify-content-md-start ms-2">
    <button class="btn btn-outline-secondary fa-solid fa-print mt-3" onclick="imprimir('{{$producto->name}}', '{{json_encode($producto->items)}}', 'mi_imagen')">
</div>

@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dompurify/3.0.1/purify.min.js"></script>

<script>

    window.jsPDF = window.jspdf.jsPDF;      // Debe ser una variable global para que funcione html2canvas

    // Genera un PDF con los datos del producto y la imagen del carrusel.
    // Recibe como parámetros el JSON del producto, el ID de la imagen en el árbol DOM, un JSON con los items del producto y el nombre de la categoría.
    function imprimir(product, json_items, image) {
        
        var items = JSON.parse(json_items);

        // Creamos un documento PDF en blanco
        var doc = new jsPDF('portrait', 'mm', 'a4');   // Creamos el PDF en tamaño A4 y con unidades en mm
        window.html2canvas = html2canvas;

        // Creamos un HTML con el contenido que queremos que tenga el PDF
        var html = '<div style="font-family: helvetica; font-size: 10pt">';
        html += 'FICHA TÉCNICA<br><hr>';
        html += '<p style="font-size: 150%"><strong>' + product + '</strong></p>';
        html += '<img src="' + document.getElementById(image).src + '" width="100%">';
        for (var i = 0; i < items.length; i++) {
            html += '<strong>' + items[i].name + ': </strong>' + items[i].pivot.value + '<br>';
        }

        // Enviamos el HTML al PDF y forzamos la descarga
        doc.html(html, {
            callback: function(doc) {
                // Save the PDF
                doc.save(product + '.pdf');
            },
            x: 15,
            y: 15,
            margin: [10, 10, 10, 10],
            autoPaging: 'text',
            width: 170, //target width in the PDF document
            windowWidth: 650 //window width in CSS pixels
        });
    }
</script>
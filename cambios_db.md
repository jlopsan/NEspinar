# CAMBIOS EN LA BASE DE DATOS TRAS NUEVO DESPLIEGUE

## Actualización info adicional página principal

### Se deberán crear 3 nuevas opciones desde el backend de la página:

- **"home_info_adicional_titulo"**: Hace referencia al titulo del área de información adicional. Valor recomendado: "**COLECCIONES DE**".

- **"home_info_adicional_image"**: Hace referencia al nombre de una imagen que se mostrará entre titulo y subtitulo. Dicha imagen deberá encontrarse en la carpeta /public de laravel. Valor recomendado: "**narciso_espinar_campra.jpg**"

- **"home_info_adicional_subtitulo"**: Hace referencia al subtitulo del área de información adicional, justo debajo de la imagen. Valor recomendado: "**NARCISO ESPINAR CAMPRA**".

Finalmente, debemos cambiar el tipo de dato de la anteriormente existente opción: "**home_info_adicional**" a tipo numérico, a su vez, debemos cambiar su valor a 1 o 0 dependiendo de si queremos que nuestra página tenga esta sección o no. 

A continuación, el SQL que nos permite automatizar esta tarea y establecer el valor inicial a 1 (true) para que la información adicional se muestre.

```sql
UPDATE opciones SET opciones.type = 'number', opciones.value = 1 WHERE opciones.key = 'home_info_adicional';
```
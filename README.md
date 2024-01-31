# CAMBIOS EN LA BASE DE DATOS TRAS NUEVO DESPLIEGUE

## Actualización info adicional página principal

### Se deberán crear 3 nuevas opciones desde el backend de la página:

- **"home_info_adicional_titulo"**: Hace referencia al titulo del área de información adicional. Valor recomendado: "**COLECCIONES DE**".

- **"home_info_adicional_image"**: Hace referencia al nombre de una imagen que se mostrará entre titulo y subtitulo. Dicha imagen deberá encontrarse en la carpeta "**/storage/app/public/images**" de laravel. Valor recomendado: "**narciso_espinar_campra.jpg**"

- **"home_info_adicional_subtitulo"**: Hace referencia al subtitulo del área de información adicional, justo debajo de la imagen. Valor recomendado: "**NARCISO ESPINAR CAMPRA**".

Finalmente, debemos cambiar el tipo de dato de la anteriormente existente opción: "**home_info_adicional**" a tipo numérico, a su vez, debemos cambiar su valor a 1 o 0 dependiendo de si queremos que nuestra página tenga esta sección o no. 

A continuación, el SQL que nos permite automatizar esta tarea y establecer el valor inicial a 1 (true) para que la información adicional se muestre.

```sql
UPDATE opciones SET 
opciones.type = 'number',
opciones.value = 1 
WHERE opciones.key = 'home_info_adicional';
```

## Normalizacion de registros de la base de datos

### Añadir etiquetas &lt;p&gt; y &lt;/p&gt; a todos los registros:

Primero se recomienda utilizar esta sentencia para ver que registros van a ser afectados:
```sql
SELECT * 
FROM items_productos
WHERE VALUE NOT LIKE '%<p%'
```

Y para modificar los registros añadiendo las etiquetas &lt;p&gt; al principio y &lt;/p&gt; al final se utiliza la siguiente sentencia:
```sql
UPDATE items_productos
SET value = CONCAT("<p>", value, "</p>")
WHERE VALUE NOT LIKE '%<p%';
```

### Eliminar todos los registros vacíos &lt;p&gt;&lt;br&gt;&lt;/p&gt; y &lt;p&gt;&lt;/p&gt; de la base de datos

Si hemos realizado el anterior paso, nos encontraremos con varios campos en la tabla **items_productos** cuyo valor es prescindible por el nuevo funcionamiento de la aplicación y que ya no son insertables de ninguna forma en la base de datos. Vamos a eliminarlos. Para ello ejecutaremos el siguiente script.

```sql
DELETE FROM items_productos 
WHERE value = '<p><br></p>' OR value = '<p></p>';
```

### Cambiar los caracteres html \&amp; y \&nbsp; por sus valores reales "&" y " "

Cuando se insertaban los valores & o " " el programa guardaba \&amp; y \&nbsp; en su lugar, este error se ha solucionado pero quedan residuos en la base de datos los cuales se pueden ver con la siguiente consulta:

```sql
SELECT *
FROM items_productos
WHERE value LIKE '%&amp;%' OR value LIKE '%&nbsp;%'
```

para sustituir estos valores por los valores correctos se puede utilizar la siguiente consulta:

```sql
UPDATE items_productos
SET value = REPLACE(value, '&amp;', '&')
WHERE value LIKE '%&amp;%';

UPDATE items_productos
SET value = REPLACE(value, '&nbsp;', '')
WHERE value LIKE '%&nbsp;%';
```
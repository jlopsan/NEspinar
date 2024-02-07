# CAMBIOS EN LA BASE DE DATOS TRAS NUEVO DESPLIEGUE

Después de hacer los mismos pasos necesarios para el despliegue anterior (subida de imagenes, storage link, key generate...), debemos ejecutar directamente el script de SQL ubicado en la carpeta db_scripts, en la carpeta raíz del proyecto.

> [!WARNING]  
> Al principio del script, se ejecuta **USE mi_app;** Cambia el nombre de la base de datos a la que referencia según proceda.

Una vez ejecutemos el script, ahora debemos cambiar un archivo de ubicación para conservar la nueva referencia.

La imagen en cuestión se encuentra en la carpeta /public y se llama **"narciso_espinar_campra.jpg"**. Debemos cambiar su ubicación a /storage/app/public/images

Ahora, vamos a añadir la imagen de Creative Commons del footer. Debemos descargarla [desde este enlace](https://licensebuttons.net/l/by-nc/4.0/88x31.png) e inculirla en la misma carpeta que la anterior imagen con el nombre de **"creative_commons.png"**


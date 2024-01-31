USE mi_app;

INSERT INTO opciones (`value`, `key`, `type`)
VALUES ('COLECCIONES DE', 'home_info_adicional_titulo', 'text');

INSERT INTO opciones (`value`, `key`, `type`)
VALUES ('Narciso Espinar Campra', 'home_info_adicional_subtitulo', 'text');

INSERT INTO opciones (`value`, `key`, `type`)
VALUES ('narciso_espinar_campra.jpg', 'home_info_adicional_image', 'image');

UPDATE opciones SET 
opciones.type = 'number',
opciones.value = 1 
WHERE opciones.key = 'home_info_adicional';

UPDATE items_productos
SET value = CONCAT("<p>", value, "</p>")
WHERE VALUE NOT LIKE '%<p%';

DELETE FROM items_productos 
WHERE value = '<p><br></p>' OR value = '<p></p>';

UPDATE items_productos
SET value = REPLACE(value, '&amp;', '&')
WHERE value LIKE '%&amp;%';

UPDATE items_productos
SET value = REPLACE(value, '&nbsp;', '')
WHERE value LIKE '%&nbsp;%';
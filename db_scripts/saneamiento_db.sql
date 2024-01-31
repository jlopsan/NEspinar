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
SET value = REPLACE(value, '&nbsp;', ' ')
WHERE value LIKE '%&nbsp;%';

UPDATE items_productos
SET value = REPLACE(value, '<br>', '')
WHERE value LIKE '%<br>%';

DELIMITER //

CREATE FUNCTION eliminar_espacios_extra(input_string VARCHAR(255))
RETURNS VARCHAR(255)
BEGIN
    DECLARE output_string VARCHAR(255);
    DECLARE i INT DEFAULT 1;

    SET output_string = '';

    WHILE i <= LENGTH(input_string) DO
        IF SUBSTRING(input_string, i, 1) != ' ' OR
           (i < LENGTH(input_string) AND SUBSTRING(input_string, i+1, 1) != ' ') THEN
            SET output_string = CONCAT(output_string, SUBSTRING(input_string, i, 1));
        END IF;
        SET i = i + 1;
    END WHILE;

    RETURN output_string;
END//

DELIMITER ;

UPDATE items_productos SET value = eliminar_espacios_extra(value);

UPDATE items_productos SET value = REPLACE(value, '<p> ', '<p>')
WHERE value LIKE '%<p> %';

UPDATE items_productos SET value = REPLACE(value, ' </p>', '</p>') 
WHERE value LIKE '% </p>%';
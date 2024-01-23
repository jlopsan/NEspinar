<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared(
            'ALTER TABLE categorias
            ADD COLUMN `order` INT DEFAULT 0;
            DROP FUNCTION IF EXISTS cleanText;
            CREATE FUNCTION cleanText(str TEXT)
                RETURNS TEXT CHARSET utf8
                DETERMINISTIC
            BEGIN
                DECLARE start INT DEFAULT 1;
                DECLARE end INT;
                DECLARE nbsp_pos INT;
                
                WHILE start > 0 DO
                    SET start = LOCATE("<", str, start);
                    SET end = LOCATE(">", str, start + 1);
                    
                    IF start > 0 AND end > 0 THEN
                        SET str = INSERT(str, start, end - start + 1, "");
                    ELSE
                        SET start = 0;
                    END IF;
                END WHILE;
                
                SET nbsp_pos = LOCATE("&nbsp;", str);
                WHILE (nbsp_pos > 0) DO
                    SET str = REPLACE(str, "&nbsp;", "");
                    SET nbsp_pos = LOCATE("&nbsp;", str);
                END WHILE;
                
                SET str = TRIM(str);
            
                RETURN str;
            END;;

            '
        );
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP FUNCTION IF EXISTS cleanText');

    }
};

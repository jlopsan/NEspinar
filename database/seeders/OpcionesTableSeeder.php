<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OpcionesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('opciones')->delete();
        
        \DB::table('opciones')->insert(array (
            0 => 
            array (
                'id' => 1,
                'value' => 'noimage.jpg',
                'key' => 'home_imagen_principal',
                'type' => 'image',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'value' => 'nologo.png',
                'key' => 'logo',
                'type' => 'image',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'value' => 'Título de la web',
                'key' => 'home_titulo',
                'type' => 'text',
                'created_at' => NULL,
                'updated_at' => '2023-02-25 08:09:32',
            ),
            3 => 
            array (
                'id' => 4,
                'value' => '#ada191',
                'key' => 'color_nav',
                'type' => 'color',
                'created_at' => NULL,
                'updated_at' => '2023-02-24 13:07:31',
            ),
            4 => 
            array (
                'id' => 5,
                'value' => '#FFFFFF',
                'key' => 'color_titulo_subtitulo',
                'type' => 'color',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'value' => '#000000',
                'key' => 'color_raton_encima_elementos_menu',
                'type' => 'color',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'value' => '#FFFFFF',
                'key' => 'color_elementos_menu',
                'type' => 'color',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'value' => '#ADA191',
                'key' => 'paginacion_color',
                'type' => 'color',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'value' => 'SUBTÍTULO DE LA WEB',
                'key' => 'home_subtitulo',
                'type' => 'text',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'value' => '#ffffff',
                'key' => 'color_fondo',
                'type' => 'color',
                'created_at' => '2023-02-27 14:11:00',
                'updated_at' => '2023-02-28 07:07:03',
            ),
            10 => 
            array (
                'id' => 11,
                'value' => 'Montserrat',
                'key' => 'tipografia1',
                'type' => 'font',
                'created_at' => '2023-02-27 14:13:29',
                'updated_at' => '2023-02-28 07:29:49',
            ),
            11 => 
            array (
                'id' => 12,
                'value' => '9',
                'key' => 'paginacion_cantidad_elementos',
                'type' => 'number',
                'created_at' => '2023-02-27 14:14:02',
                'updated_at' => '2023-02-27 14:14:02',
            ),
            12 => 
            array (
                'id' => 13,
                'value' => 'Aquí irá la página de política de privacidad',
                'key' => 'politica_privacidad',
                'type' => 'longText',
                'created_at' => '2023-02-27 14:14:41',
                'updated_at' => '2023-02-27 14:14:41',
            ),
            13 => 
            array (
                'id' => 14,
                'value' => 'Aquí irá la política de cookies',
                'key' => 'politica_cookies',
                'type' => 'longText',
                'created_at' => '2023-02-27 14:15:08',
                'updated_at' => '2023-02-27 14:15:08',
            ),
            14 => 
            array (
                'id' => 15,
                'value' => 'Aquí irá la página de términos de uso',
                'key' => 'terminos_uso',
                'type' => 'longText',
                'created_at' => '2023-02-27 14:15:25',
                'updated_at' => '2023-02-27 14:15:25',
            ),
            15 => 
            array (
                'id' => 16,
                'value' => '1',
                'key' => 'acerca_de_visibilidad',
                'type' => 'number',
                'created_at' => '2023-02-27 14:15:51',
                'updated_at' => '2023-02-27 14:15:51',
            ),
            16 => 
            array (
                'id' => 17,
                'value' => 'Acerca de',
                'key' => 'acerca_de_texto_menu',
                'type' => 'text',
                'created_at' => '2023-02-27 14:16:21',
                'updated_at' => '2023-02-27 14:16:21',
            ),
            17 => 
            array (
                'id' => 18,
                'value' => 'Aquí irá el contenido de la página "Acerca de"',
                'key' => 'acerca_de_contenido',
                'type' => 'longText',
                'created_at' => '2023-02-27 14:17:00',
                'updated_at' => '2023-02-27 16:28:46',
            ),
            18 => 
            array (
                'id' => 19,
                'value' => '#000000',
                'key' => 'color_sombra_titulo_subtitulo',
                'type' => 'color',
                'created_at' => '2023-02-27 16:01:21',
                'updated_at' => '2023-02-28 07:12:48',
            ),
            19 => 
            array (
                'id' => 20,
                'value' => 'Aquí irá la información adicional de la página de inicio',
                'key' => 'home_info_adicional',
                'type' => 'longText',
                'created_at' => '2023-02-27 16:12:48',
                'updated_at' => '2023-02-27 16:33:33',
            ),
            20 => 
            array (
                'id' => 21,
                'value' => 'Roboto Slab',
                'key' => 'tipografia2',
                'type' => 'font',
                'created_at' => '2023-02-28 07:31:40',
                'updated_at' => '2023-02-28 07:31:40',
            ),
            21 => 
            array (
                'id' => 22,
                'value' => '50',
                'key' => 'logo_alto',
                'type' => 'number',
                'created_at' => '2023-02-28 07:31:40',
                'updated_at' => '2023-02-28 07:31:40',
            ),
            22 => 
            array (
                'id' => 23,
                'value' => '130',
                'key' => 'logo_ancho',
                'type' => 'number',
                'created_at' => '2023-02-28 07:31:40',
                'updated_at' => '2023-02-28 07:31:40',
            ),
            23 => 
            array (
                'id' => 24,
                'value' => 'Roboto',
                'key' => 'tipografia3',
                'type' => 'font',
                'created_at' => '2023-02-28 07:31:40',
                'updated_at' => '2023-02-28 07:31:40',
            ),
            24 => 
            array (
                'id' => 25,
                'value' => "Lato\nMerriweather\nMontserrat\nOpen Sans\nOswald\nRoboto\nRoboto\nFasthand\nPatrick Hand\nMedievalSharp\nUnbounded\nCinzel",
                'key' => 'tipografias_disponibles',
                'type' => 'longText',
                'created_at' => '2023-02-28 07:31:40',
                'updated_at' => '2023-02-28 07:31:40',
            ),
            25 => 
            array (
                'id' => 26,
                'value' => '#6a645c',
                'key' => 'color_cat_activa',
                'type' => 'color',
                'created_at' => '2023-02-28 07:31:40',
                'updated_at' => '2023-02-28 07:31:40',
            ),
            26 => 
            array (
                'id' => 27,
                'value' => '1',
                'key' => 'texto_enriquecido',
                'type' => 'number',
                'created_at' => '2023-02-28 07:31:40',
                'updated_at' => '2023-02-28 07:31:40',
            ),
            27 =>
            array (
                'id' => 28,
                'value' => '9',
                'key' => 'paginacion_back',
                'type' => 'number',
                'created_at' => '2023-02-27 14:14:02',
                'updated_at' => '2023-02-27 14:14:02',
            ),
            28 =>
            array (
                'id' => 29,
                'value' => 'noimage.jpg',
                'key' => 'favicon',
                'type' => 'image',
                'created_at' => '2023-02-27 14:14:02',
                'updated_at' => '2023-02-27 14:14:02',
            ),

            29 =>
            array (
                'id' => 230,
                'value' => 'noimage.jpg',
                'key' => 'logo_login',
                'type' => 'image',
                'created_at' => '2023-02-27 14:14:02',
                'updated_at' => '2023-02-27 14:14:02',
            ),
        ));
        
        
    }
}
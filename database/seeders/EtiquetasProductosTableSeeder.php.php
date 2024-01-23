<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;


class EtiquetasProductosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('items_productos')->insert([
            'productos_id' => '1',
            'etiquetas_id' => '3',
        ]);

        DB::table('items_productos')->insert([
            'productos_id' => '2',
            'etiquetas_id' => '1',
        ]);

        DB::table('items_productos')->insert([
            'productos_id' => '3',
            'etiquetas_id' => '2',
        ]);
    }
}
<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    $this->call(CategoriasTableSeeder::class);
    $this->call(ProductosTableSeeder::class);
    $this->call(EtiquetasTableSeeder::class);
    $this->call(ImagenesTableSeeder::class);
    $this->call(ItemsTableSeeder::class);
    $this->call(OpcionesTableSeeder::class);
    $this->call(UsuariosTableSeeder::class);
    $this->call(ItemsProductosTableSeeder::class);

    
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}

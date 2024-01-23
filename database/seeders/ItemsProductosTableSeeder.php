<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;


class ItemsProductosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        ////////////////////////////////////////////////////////
                            //POSTALES
        ////////////////////////////////////////////////////////
        DB::table('items_productos')->insert([
            'productos_id' => '1',
            'items_id' => '10',
            'value' => 'DEF456', // Ejemplo de código de serie
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '1',
            'items_id' => '11',
            'value' => '8 cm x 12 cm x 3 cm', // Ejemplo de dimensiones del producto
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '1',
            'items_id' => '12',
            'value' => 'Imagen del anverso del producto 2', // Ejemplo del contenido del anverso
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '1',
            'items_id' => '13',
            'value' => 'Imagen del reverso del producto 2', // Ejemplo del contenido del reverso
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '1',
            'items_id' => '14',
            'value' => 'Emma Johnson', // Ejemplo del nombre del editor
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '1',
            'items_id' => '15',
            'value' => 'David Smith', // Ejemplo del nombre del impresor
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '1',
            'items_id' => '16',
            'value' => 'Michael Davis', // Ejemplo del nombre del ilustrador
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '1',
            'items_id' => '17',
            'value' => 'Impresión en blanco y negro', // Ejemplo del tipo de impresión
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '1',
            'items_id' => '18',
            'value' => '2020-05-01', // Ejemplo de fecha más antigua
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '1',
            'items_id' => '19',
            'value' => '2023-01-10', // Ejemplo de fecha de edición
        ]);
        
        
        DB::table('items_productos')->insert([
            'productos_id' => '2',
            'items_id' => '10',
            'value' => 'GHI789', // Ejemplo de código de serie
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '2',
            'items_id' => '11',
            'value' => '15 cm x 20 cm x 6 cm', // Ejemplo de dimensiones del producto
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '2',
            'items_id' => '12',
            'value' => 'Imagen del anverso del producto 3', // Ejemplo del contenido del anverso
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '2',
            'items_id' => '13',
            'value' => 'Imagen del reverso del producto 3', // Ejemplo del contenido del reverso
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '2',
            'items_id' => '14',
            'value' => 'Olivia Wilson', // Ejemplo del nombre del editor
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '2',
            'items_id' => '15',
            'value' => 'Sophia Brown', // Ejemplo del nombre del impresor
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '2',
            'items_id' => '16',
            'value' => 'Emily Anderson', // Ejemplo del nombre del ilustrador
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '2',
            'items_id' => '17',
            'value' => 'Impresión en escala de grises', // Ejemplo del tipo de impresión
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '2',
            'items_id' => '18',
            'value' => '2019-11-15', // Ejemplo de fecha más antigua
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '2',
            'items_id' => '19',
            'value' => '2022-09-30', // Ejemplo de fecha de edición
        ]);
        
        
        DB::table('items_productos')->insert([
            'productos_id' => '3',
            'items_id' => '10',
            'value' => 'JKL012', // Ejemplo de código de serie
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '3',
            'items_id' => '11',
            'value' => '12 cm x 18 cm x 4 cm', // Ejemplo de dimensiones del producto
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '3',
            'items_id' => '12',
            'value' => 'Imagen del anverso del producto 4', // Ejemplo del contenido del anverso
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '3',
            'items_id' => '13',
            'value' => 'Imagen del reverso del producto 4', // Ejemplo del contenido del reverso
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '3',
            'items_id' => '14',
            'value' => 'James Thompson', // Ejemplo del nombre del editor
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '3',
            'items_id' => '15',
            'value' => 'William Harris', // Ejemplo del nombre del impresor
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '3',
            'items_id' => '16',
            'value' => 'Daniel Clark', // Ejemplo del nombre del ilustrador
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '3',
            'items_id' => '17',
            'value' => 'Impresión en tonos sepia', // Ejemplo del tipo de impresión
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '3',
            'items_id' => '18',
            'value' => '2021-07-20', // Ejemplo de fecha más antigua
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '3',
            'items_id' => '19',
            'value' => '2023-03-18', // Ejemplo de fecha de edición
        ]);
        
        
        DB::table('items_productos')->insert([
            'productos_id' => '4',
            'items_id' => '10',
            'value' => 'MNO345', // Ejemplo de código de serie
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '4',
            'items_id' => '11',
            'value' => '10 cm x 15 cm x 2 cm', // Ejemplo de dimensiones del producto
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '4',
            'items_id' => '12',
            'value' => 'Imagen del anverso del producto 5', // Ejemplo del contenido del anverso
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '4',
            'items_id' => '13',
            'value' => 'Imagen del reverso del producto 5', // Ejemplo del contenido del reverso
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '4',
            'items_id' => '14',
            'value' => 'Ava Roberts', // Ejemplo del nombre del editor
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '4',
            'items_id' => '15',
            'value' => 'Ethan Wilson', // Ejemplo del nombre del impresor
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '4',
            'items_id' => '16',
            'value' => 'Sophia Davis', // Ejemplo del nombre del ilustrador
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '4',
            'items_id' => '17',
            'value' => 'Impresión en color', // Ejemplo del tipo de impresión
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '4',
            'items_id' => '18',
            'value' => '2022-02-10', // Ejemplo de fecha más antigua
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '4',
            'items_id' => '19',
            'value' => '2023-05-25', // Ejemplo de fecha de edición
        ]);
        

        DB::table('items_productos')->insert([
            'productos_id' => '5',
            'items_id' => '10',
            'value' => 'PQR678', // Ejemplo de código de serie
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '5',
            'items_id' => '11',
            'value' => '8 cm x 12 cm x 1 cm', // Ejemplo de dimensiones del producto
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '5',
            'items_id' => '12',
            'value' => 'Imagen del anverso del producto 6', // Ejemplo del contenido del anverso
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '5',
            'items_id' => '13',
            'value' => 'Imagen del reverso del producto 6', // Ejemplo del contenido del reverso
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '5',
            'items_id' => '14',
            'value' => 'Oliver Johnson', // Ejemplo del nombre del editor
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '5',
            'items_id' => '15',
            'value' => 'Sophia White', // Ejemplo del nombre del impresor
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '5',
            'items_id' => '16',
            'value' => 'Mia Anderson', // Ejemplo del nombre del ilustrador
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '5',
            'items_id' => '17',
            'value' => 'Impresión en blanco y negro', // Ejemplo del tipo de impresión
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '5',
            'items_id' => '18',
            'value' => '2023-01-05', // Ejemplo de fecha más antigua
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '5',
            'items_id' => '19',
            'value' => '2023-04-12', // Ejemplo de fecha de edición
        ]);
        
        
        DB::table('items_productos')->insert([
            'productos_id' => '6',
            'items_id' => '10',
            'value' => 'STU901', // Ejemplo de código de serie
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '6',
            'items_id' => '11',
            'value' => '15 cm x 20 cm x 3 cm', // Ejemplo de dimensiones del producto
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '6',
            'items_id' => '12',
            'value' => 'Imagen del anverso del producto 7', // Ejemplo del contenido del anverso
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '6',
            'items_id' => '13',
            'value' => 'Imagen del reverso del producto 7', // Ejemplo del contenido del reverso
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '6',
            'items_id' => '14',
            'value' => 'Noah Thompson', // Ejemplo del nombre del editor
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '6',
            'items_id' => '15',
            'value' => 'Emma Martinez', // Ejemplo del nombre del impresor
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '6',
            'items_id' => '16',
            'value' => 'Avery Turner', // Ejemplo del nombre del ilustrador
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '6',
            'items_id' => '17',
            'value' => 'Impresión en tonos sepia', // Ejemplo del tipo de impresión
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '6',
            'items_id' => '18',
            'value' => '2022-12-20', // Ejemplo de fecha más antigua
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '6',
            'items_id' => '19',
            'value' => '2023-03-08', // Ejemplo de fecha de edición
        ]);
        


        DB::table('items_productos')->insert([
            'productos_id' => '7',
            'items_id' => '10',
            'value' => 'XYZ123', // Ejemplo de código de serie
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '7',
            'items_id' => '11',
            'value' => '18 cm x 24 cm x 2 cm', // Ejemplo de dimensiones del producto
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '7',
            'items_id' => '12',
            'value' => 'Imagen del anverso del producto 8', // Ejemplo del contenido del anverso
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '7',
            'items_id' => '13',
            'value' => 'Imagen del reverso del producto 8', // Ejemplo del contenido del reverso
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '7',
            'items_id' => '14',
            'value' => 'Sophie Harris', // Ejemplo del nombre del editor
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '7',
            'items_id' => '15',
            'value' => 'James Wilson', // Ejemplo del nombre del impresor
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '7',
            'items_id' => '16',
            'value' => 'Ella Thompson', // Ejemplo del nombre del ilustrador
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '7',
            'items_id' => '17',
            'value' => 'Impresión a color', // Ejemplo del tipo de impresión
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '7',
            'items_id' => '18',
            'value' => '2022-11-10', // Ejemplo de fecha más antigua
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '7',
            'items_id' => '19',
            'value' => '2023-02-18', // Ejemplo de fecha de edición
        ]);
        
        
        DB::table('items_productos')->insert([
            'productos_id' => '8',
            'items_id' => '10',
            'value' => 'ABC456', // Ejemplo de código de serie
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '8',
            'items_id' => '11',
            'value' => '10 cm x 15 cm x 0.5 cm', // Ejemplo de dimensiones del producto
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '8',
            'items_id' => '12',
            'value' => 'Imagen del anverso del producto 9', // Ejemplo del contenido del anverso
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '8',
            'items_id' => '13',
            'value' => 'Imagen del reverso del producto 9', // Ejemplo del contenido del reverso
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '8',
            'items_id' => '14',
            'value' => 'Oliver Clark', // Ejemplo del nombre del editor
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '8',
            'items_id' => '15',
            'value' => 'Emily Davis', // Ejemplo del nombre del impresor
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '8',
            'items_id' => '16',
            'value' => 'Liam Turner', // Ejemplo del nombre del ilustrador
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '8',
            'items_id' => '17',
            'value' => 'Impresión en blanco y negro', // Ejemplo del tipo de impresión
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '8',
            'items_id' => '18',
            'value' => '2022-10-05', // Ejemplo de fecha más antigua
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '8',
            'items_id' => '19',
            'value' => '2023-01-12', // Ejemplo de fecha de edición
        ]);
        
        
        DB::table('items_productos')->insert([
            'productos_id' => '9',
            'items_id' => '10',
            'value' => 'PQR789', // Ejemplo de código de serie
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '9',
            'items_id' => '11',
            'value' => '30 cm x 40 cm x 3 cm', // Ejemplo de dimensiones del producto
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '9',
            'items_id' => '12',
            'value' => 'Imagen del anverso del producto 10', // Ejemplo del contenido del anverso
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '9',
            'items_id' => '13',
            'value' => 'Imagen del reverso del producto 10', // Ejemplo del contenido del reverso
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '9',
            'items_id' => '14',
            'value' => 'Harper Anderson', // Ejemplo del nombre del editor
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '9',
            'items_id' => '15',
            'value' => 'Ethan Thompson', // Ejemplo del nombre del impresor
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '9',
            'items_id' => '16',
            'value' => 'Ava White', // Ejemplo del nombre del ilustrador
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '9',
            'items_id' => '17',
            'value' => 'Impresión en tonos sepia', // Ejemplo del tipo de impresión
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '9',
            'items_id' => '18',
            'value' => '2022-09-01', // Ejemplo de fecha más antigua
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '9',
            'items_id' => '19',
            'value' => '2023-03-25', // Ejemplo de fecha de edición
        ]);
        

        ////////////////////////////////////////////////////////
                        //PIEZAS ARQUEOLÓGICAS
        ////////////////////////////////////////////////////////

        DB::table('items_productos')->insert([
            'productos_id' => '10',
            'items_id' => '1',
            'value' => '98765', // Ejemplo del número
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '10',
            'items_id' => '2',
            'value' => 'Función de prueba', // Ejemplo de la función
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '10',
            'items_id' => '3',
            'value' => '15 cm x 25 cm x 3 cm', // Ejemplo de las dimensiones
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '10',
            'items_id' => '4',
            'value' => 'Características técnicas ficticias', // Ejemplo de las características técnicas
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '10',
            'items_id' => '5',
            'value' => 'Morfología de prueba', // Ejemplo de la morfología
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '10',
            'items_id' => '6',
            'value' => 'Origen imaginario', // Ejemplo de la procedencia
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '10',
            'items_id' => '7',
            'value' => 'Siglo XXI', // Ejemplo de la cronología
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '10',
            'items_id' => '8',
            'value' => 'Depósito temporal', // Ejemplo del depósito
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '10',
            'items_id' => '9',
            'value' => 'Referencia bibliográfica no válida', // Ejemplo de la bibliografía
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '11',
            'items_id' => '1',
            'value' => '54321', // Ejemplo del número
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '11',
            'items_id' => '2',
            'value' => 'Otra función de prueba', // Ejemplo de la función
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '11',
            'items_id' => '3',
            'value' => '10 cm x 20 cm x 2 cm', // Ejemplo de las dimensiones
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '11',
            'items_id' => '4',
            'value' => 'Otras características técnicas ficticias', // Ejemplo de las características técnicas
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '11',
            'items_id' => '5',
            'value' => 'Otra morfología de prueba', // Ejemplo de la morfología
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '11',
            'items_id' => '6',
            'value' => 'Otro origen imaginario', // Ejemplo de la procedencia
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '11',
            'items_id' => '7',
            'value' => 'Siglo XX', // Ejemplo de la cronología
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '11',
            'items_id' => '8',
            'value' => 'Depósito permanente', // Ejemplo del depósito
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '11',
            'items_id' => '9',
            'value' => 'Otra referencia bibliográfica', // Ejemplo de la bibliografía
        ]);

        DB::table('items_productos')->insert([
            'productos_id' => '12',
            'items_id' => '1',
            'value' => '13579', // Ejemplo del número
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '12',
            'items_id' => '2',
            'value' => 'Función principal', // Ejemplo de la función
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '12',
            'items_id' => '3',
            'value' => '18 cm x 30 cm x 5 cm', // Ejemplo de las dimensiones
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '12',
            'items_id' => '4',
            'value' => 'Características técnicas detalladas', // Ejemplo de las características técnicas
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '12',
            'items_id' => '5',
            'value' => 'Esferoidal', // Ejemplo de la morfología real
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '12',
            'items_id' => '6',
            'value' => 'Procedencia histórica', // Ejemplo de la procedencia real
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '12',
            'items_id' => '7',
            'value' => 'Siglo XIX', // Ejemplo de la cronología
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '12',
            'items_id' => '8',
            'value' => 'Depósito de colección', // Ejemplo del depósito
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '12',
            'items_id' => '9',
            'value' => 'Referencia bibliográfica válida', // Ejemplo de la bibliografía
        ]);

        DB::table('items_productos')->insert([
            'productos_id' => '13',
            'items_id' => '1',
            'value' => '24680', // Ejemplo del número
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '13',
            'items_id' => '2',
            'value' => 'Función secundaria', // Ejemplo de la función
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '13',
            'items_id' => '3',
            'value' => '12 cm x 20 cm x 2 cm', // Ejemplo de las dimensiones
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '13',
            'items_id' => '4',
            'value' => 'Características técnicas resumidas', // Ejemplo de las características técnicas
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '13',
            'items_id' => '5',
            'value' => 'Cúbica', // Ejemplo de la morfología real
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '13',
            'items_id' => '6',
            'value' => 'Procedencia contemporánea', // Ejemplo de la procedencia real
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '13',
            'items_id' => '7',
            'value' => 'Siglo XX', // Ejemplo de la cronología
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '13',
            'items_id' => '8',
            'value' => 'Depósito temporal', // Ejemplo del depósito
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '13',
            'items_id' => '9',
            'value' => 'Referencia bibliográfica actual', // Ejemplo de la bibliografía
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '15',
            'items_id' => '1',
            'value' => '13579', // Ejemplo del número
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '15',
            'items_id' => '2',
            'value' => 'Función principal', // Ejemplo de la función
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '15',
            'items_id' => '3',
            'value' => '18 cm x 30 cm x 5 cm', // Ejemplo de las dimensiones
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '15',
            'items_id' => '4',
            'value' => 'Características técnicas detalladas', // Ejemplo de las características técnicas
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '15',
            'items_id' => '5',
            'value' => 'Esférica', // Ejemplo de la morfología real
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '15',
            'items_id' => '6',
            'value' => 'Procedencia histórica', // Ejemplo de la procedencia real
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '15',
            'items_id' => '7',
            'value' => 'Siglo XIX', // Ejemplo de la cronología
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '15',
            'items_id' => '8',
            'value' => 'Depósito permanente', // Ejemplo del depósito
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '15',
            'items_id' => '9',
            'value' => 'Referencia bibliográfica clásica', // Ejemplo de la bibliografía
        ]);

        DB::table('items_productos')->insert([
            'productos_id' => '16',
            'items_id' => '1',
            'value' => '75391', // Ejemplo del número
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '16',
            'items_id' => '2',
            'value' => 'Función adicional', // Ejemplo de la función
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '16',
            'items_id' => '3',
            'value' => '8 cm x 8 cm x 8 cm', // Ejemplo de las dimensiones
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '16',
            'items_id' => '4',
            'value' => 'Características técnicas mejoradas', // Ejemplo de las características técnicas
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '16',
            'items_id' => '5',
            'value' => 'Ovalada', // Ejemplo de la morfología real
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '16',
            'items_id' => '6',
            'value' => 'Procedencia local', // Ejemplo de la procedencia real
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '16',
            'items_id' => '7',
            'value' => 'Siglo XVIII', // Ejemplo de la cronología
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '16',
            'items_id' => '8',
            'value' => 'Depósito permanente', // Ejemplo del depósito
        ]);
        
        DB::table('items_productos')->insert([
            'productos_id' => '16',
            'items_id' => '9',
            'value' => 'Referencia bibliográfica histórica', // Ejemplo de la bibliografía
        ]);
        
        
        
        

    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Producto A',
                'description' => 'Este es un producto de ejemplo A. Es útil para todo tipo de tareas diarias.',
                'image' => 'product_a.jpg',
                'price' => 199.99,
                'discount' => 10.00,  // 10% de descuento
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Producto B',
                'description' => 'Producto B es ideal para mejorar la productividad en la oficina. Alta calidad.',
                'image' => 'product_b.jpg',
                'price' => 350.50,
                'discount' => 20.00,  // 20% de descuento
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Producto C',
                'description' => 'Una herramienta avanzada para desarrolladores, con múltiples funcionalidades.',
                'image' => 'product_c.jpg',
                'price' => 499.99,
                'discount' => null,  // Sin descuento
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Producto D',
                'description' => 'El producto D es una opción económica para tareas básicas de oficina.',
                'image' => 'product_d.jpg',
                'price' => 99.99,
                'discount' => 5.00,  // 5% de descuento
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Producto E',
                'description' => 'Producto premium con excelentes características, ideal para entusiastas.',
                'image' => 'product_e.jpg',
                'price' => 799.99,
                'discount' => 15.00,  // 15% de descuento
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Producto F',
                'description' => 'El producto F es una herramienta de alto rendimiento para desarrolladores.',
                'image' => 'product_f.jpg',
                'price' => 19.99,
                'discount' => null,  // Sin descuento
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Product::insert($products);
    }
}

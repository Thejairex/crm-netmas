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
                'category_id' => 1,
                'is_supplier_pack' => false,
                'price' => 199.99,
                'discount' => 10,
            ],
            [
                'name' => 'Producto B',
                'description' => 'Producto B es ideal para mejorar la productividad en la oficina. Alta calidad.',
                'image' => 'product_b.jpg',
                'category_id' => 1,
                'is_supplier_pack' => false,
                'price' => 350.50,
                'discount' => 20,
            ],
            [
                'name' => 'Producto C',
                'description' => 'Una herramienta avanzada para desarrolladores, con múltiples funcionalidades.',
                'image' => 'product_c.jpg',
                'category_id' => 2,
                'is_supplier_pack' => false,
                'price' => 499.99,
                'discount' => null, // Valor faltante manejado como null
            ],
            [
                'name' => 'Producto D',
                'description' => 'El producto D es una opción económica para tareas básicas de oficina.',
                'image' => 'product_d.jpg',
                'category_id' => 1,
                'is_supplier_pack' => false,
                'price' => 99.99,
                'discount' => 5,
            ],
            [
                'name' => 'Producto E',
                'description' => 'Producto premium con excelentes características, ideal para entusiastas.',
                'image' => 'product_e.jpg',
                'category_id' => 2,
                'is_supplier_pack' => false,
                'price' => 799.99,
                'discount' => 15,
            ],
            [
                'name' => 'Producto F',
                'description' => 'El producto F es una herramienta de alto rendimiento para desarrolladores.',
                'image' => 'product_f.jpg',
                'category_id' => 2,
                'is_supplier_pack' => false,
                'price' => 19.99,
                'discount' => null, // Valor faltante manejado como null
            ],
            [
                'name' => 'Basic Supplier Package',
                'description' => 'Paquete de proveedor.',
                'image' => 'supplier_package.jpg',
                'category_id' => 3,
                'is_supplier_pack' => true,
                'price' => 149.99,
                'discount' => null, // Valor faltante manejado como null
            ],
        ];

        Product::insert($products);
    }
}

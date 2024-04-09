<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->double('precio', 8, 2);
            $table->integer('stock')->default(0);
            $table->integer('vendido')->default(0);
            $table->foreignId('tipo_estado_tipos_id')->constrained('tipo_productos')->onDelete('cascade');
            $table->timestamps();
        });
        
        DB::table('productos')->insert([
            [
                'nombre' => 'Arroz Blanco',
                'descripcion' => 'Arroz blanco de grano largo',
                'precio' => 2.99,
                'stock' => 100,
                'vendido' => 0,
                'tipo_estado_tipos_id' => 1, // Alimentos secos
            ],
            [
                'nombre' => 'Leche Descremada',
                'descripcion' => 'Leche descremada en envase de litro',
                'precio' => 1.99,
                'stock' => 100,
                'vendido' => 0,
                'tipo_estado_tipos_id' => 2, // Productos lácteos
            ],
            [
                'nombre' => 'Pollo Fresco',
                'descripcion' => 'Pollo fresco sin hueso',
                'precio' => 5.99,
                'stock' => 100,
                'vendido' => 0,
                'tipo_estado_tipos_id' => 3, // Carnes frescas
            ],
            [
                'nombre' => 'Manzanas',
                'descripcion' => 'Manzanas rojas frescas',
                'precio' => 3.49,
                'stock' => 100,
                'vendido' => 0,
                'tipo_estado_tipos_id' => 4, // Frutas frescas
            ],
            [
                'nombre' => 'Lechuga',
                'descripcion' => 'Lechuga verde fresca',
                'precio' => 1.29,
                'stock' => 100,
                'vendido' => 0,
                'tipo_estado_tipos_id' => 5, // Verduras frescas
            ],
            [
                'nombre' => 'Cerveza Lager',
                'descripcion' => 'Cerveza Lager en lata',
                'precio' => 0.99,
                'stock' => 100,
                'vendido' => 0,
                'tipo_estado_tipos_id' => 6, // Bebidas alcohólicas
            ],
            [
                'nombre' => 'Agua Mineral',
                'descripcion' => 'Agua mineral natural en botella de 500ml',
                'precio' => 0.75,
                'stock' => 100,
                'vendido' => 0,
                'tipo_estado_tipos_id' => 7, // Bebidas no alcohólicas
            ],
            [
                'nombre' => 'Detergente Líquido',
                'descripcion' => 'Detergente líquido para lavar ropa',
                'precio' => 4.49,
                'stock' => 100,
                'vendido' => 0,
                'tipo_estado_tipos_id' => 8, // Artículos de limpieza
            ],
            [
                'nombre' => 'Pasta de Dientes',
                'descripcion' => 'Pasta de dientes con fluoruro',
                'precio' => 2.29,
                'stock' => 100,
                'vendido' => 0,
                'tipo_estado_tipos_id' => 9, // Productos de higiene personal
            ],
            [
                'nombre' => 'Toallas de Papel',
                'descripcion' => 'Toallas de papel absorbentes',
                'precio' => 1.99,
                'stock' => 100,
                'vendido' => 0,
                'tipo_estado_tipos_id' => 10, // Artículos para el hogar
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};

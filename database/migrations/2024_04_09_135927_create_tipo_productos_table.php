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
        Schema::create('tipo_productos', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
            $table->timestamps();
        });
          DB::table('tipo_productos')->insert(
            array(
                ['descripcion' => 'Alimentos secos'],
                ['descripcion' => 'Productos lácteos'],
                ['descripcion' => 'Carnes frescas'],
                ['descripcion' => 'Frutas frescas'],
                ['descripcion' => 'Verduras frescas'],
                ['descripcion' => 'Bebidas alcohólicas'],
                ['descripcion' => 'Bebidas no alcohólicas'],
                ['descripcion' => 'Artículos de limpieza'],
                ['descripcion' => 'Productos de higiene personal'],
                ['descripcion' => 'Artículos para el hogar']
            )
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_productos');
    }
};

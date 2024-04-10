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
        Schema::create('tipo_estado_ventas', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
            $table->timestamps();
        });
          DB::table('tipo_estado_ventas')->insert(
            array(
                [
                    'id' => 1,
                    'descripcion' => 'Vendido',
                ],
                [
                    'id' => 2,
                    'descripcion' => 'Pedido',
                ],
                [
                    'id' => 3,
                    'descripcion' => 'Eliminado',
                ],
            )
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_estado_ventas');
    }
};

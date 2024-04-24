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
        Schema::create('tipo_cantidads', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
            $table->timestamps();
        });
          DB::table('tipo_cantidads')->insert(
            array(
                [
                    'id' => 1,
                    'descripcion' => 'Kilogramo(s)',
                ],
                [
                    'id' => 2,
                    'descripcion' => 'Unidad(es)',
                ],
                [
                    'id' => 3,
                    'descripcion' => 'Metro(s)',
                ],
            )
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_cantidads');
    }
};

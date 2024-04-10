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
        Schema::create('tipo_usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
            $table->timestamps();
        });
          DB::table('tipo_usuarios')->insert(
            array(
                [
                    'id' => 1,
                    'descripcion' => 'Invitado',
                ],
                [
                    'id' => 3,
                    'descripcion' => 'Administrador',
                ],
            )
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_usuarios');
    }
};

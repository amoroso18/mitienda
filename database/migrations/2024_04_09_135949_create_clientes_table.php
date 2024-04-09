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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('denominacion')->nullable();
            $table->foreignId('tipo_documento_id')->constrained('tipo_documento')->onDelete('cascade');
            $table->string('documento_identidad')->nullable(); // DNI o RUC
            $table->string('codigo_documento')->nullable(); // Código de documento de identidad
            $table->string('direccion')->nullable();
            $table->string('telefono')->nullable();
            $table->string('email')->nullable();
            $table->timestamps();
        });
        
        DB::table('clientes')->insert([
            [
                'denominacion' => 'Juan Pérez',
                'tipo_documento_id' => 1,
                'documento_identidad' => 'DNI',
                'codigo_documento' => '12345678',
                'direccion' => 'Calle 123',
                'telefono' => '555-1234',
                'email' => 'juan@example.com',
            ],
            [
                'denominacion' => 'Empresa XYZ',
                'tipo_documento_id' => 2,
                'documento_identidad' => 'RUC',
                'codigo_documento' => '12345678901',
                'direccion' => 'Av. Principal',
                'telefono' => '555-5678',
                'email' => 'info@empresa.com',
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};

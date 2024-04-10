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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('tipo_usuarios_id')->default(1);
            // $table->foreign('tipo_usuarios_id')->references('id')->on('tipo_usuarios')->onDelete('cascade');   
            // $table->unsignedBigInteger('tipo_estado_usuarios_id')->default(1);
            // $table->foreign('tipo_estado_usuarios_id')->references('id')->on('tipo_estado_usuarios')->onDelete('cascade');   

            $table->foreignId('tipo_usuarios_id')->constrained('tipo_usuarios')->onDelete('cascade');
            $table->foreignId('tipo_estado_usuarios_id')->constrained('tipo_estado_usuarios')->onDelete('cascade');
            $table->string('email');
            $table->string('name')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
        DB::table('users')->insert(
            array(
                [
                    'id' => 1,
                    'tipo_usuarios_id' => 3,
                    'tipo_estado_usuarios_id' => 1,
                    'email' => 'admin@mitienda.com',
                    'name' => 'Administrador',
                    'email_verified_at' => '2024-04-09 10:00:00',
                    'password' => '$2y$12$UVOsc3lDEh5bZcx75wP2zOSFALUy0M.eLUnQaE6N1G8Ve7VIalKFa',
                ],
                [
                    'id' => 2,
                    'tipo_usuarios_id' => 1,
                    'tipo_estado_usuarios_id' => 1,
                    'email' => 'cliente@mitienda.com',
                    'name' => 'Cliente',
                    'email_verified_at' => '2024-04-09 10:00:00',
                    'password' => '$2y$12$UVOsc3lDEh5bZcx75wP2zOSFALUy0M.eLUnQaE6N1G8Ve7VIalKFa',
                ],
            )
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

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
            Schema::create('solicitudes', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->unsignedBigInteger('user_id_rpta')->nullable();
                $table->string('tipo');
                $table->text('comentario')->nullable();
                $table->text('observaciones')->nullable();
                $table->timestamp('fecha_envio');
                $table->enum('estado', ['Pendiente', 'Aprobado', 'Rechazado'])->default('Pendiente');
                $table->string('archivo')->nullable();
                $table->timestamps();
            });
        }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('');
    }
};

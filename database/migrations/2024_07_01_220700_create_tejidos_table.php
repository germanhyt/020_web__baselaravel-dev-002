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
        Schema::create('tejidos', function (Blueprint $table) {
            $table->id();

            $table->string('descripcion');
            $table->integer('galga');
            $table->integer('diametro');
            $table->integer('agujas');
            $table->decimal('ancho', 10, 2);
            $table->decimal('densidad', 10, 2);
            $table->decimal('densidadgw', 10, 2);
            $table->decimal('encogimientolargo', 10, 2);
            $table->decimal('encogimientoancho', 10, 2);
            $table->integer('revirado');
            $table->unsignedBigInteger('id_tipoacabado');
            $table->foreign('id_tipoacabado')
                ->references('id')
                ->on('tipoacabados')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('id_tipotejido');
            $table->foreign('id_tipotejido')
                ->references('id')
                ->on('tipotejidos')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            // 2DA FORMA: PARA SIMPLIFICAR EL CODIGO
            // $table->foreignId('idtipotejido')
            //     ->constrained('')
            //     ->onDelete('cascade')
            //     ->onUpdate('cascade');
            $table->decimal('antipilling', 10, 2);
            $table->decimal('costo_por_kg', 10, 2);
            $table->string('ficha');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tejidos');
    }
};

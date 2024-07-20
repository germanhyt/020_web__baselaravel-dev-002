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
        Schema::create('tejidoshilados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_tejido')
                ->nullable();
            $table->foreign('id_tejido')
                ->references('id')
                ->on('tejidos')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('id_hilado')
                ->nullable();
            $table->foreign('id_hilado')
                ->references('id')
                ->on('hilados')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->float('lm');
            $table->float('participacion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tejidoshilados');
    }
};

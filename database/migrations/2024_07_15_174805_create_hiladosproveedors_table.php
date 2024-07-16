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
        Schema::create('hiladosproveedors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_hilado')
                ->nullable();
            $table->foreign('id_hilado')
                ->references('id')
                ->on('hilados')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('id_proveedor')
                ->nullable();
            $table->foreign('id_proveedor')
                ->references('id')
                ->on('proveedors')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->decimal('costo_por_kg', 8, 2);
            $table->date('vigencia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hiladosproveedors');
    }
};

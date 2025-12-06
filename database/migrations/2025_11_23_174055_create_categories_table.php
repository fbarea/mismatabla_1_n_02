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
         Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('category_name');
            $table->text('category_description')->nullable();

            // Columna parent_id para jerarquía
            $table->unsignedBigInteger('parent_id')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
             
        // Opción: agregar foreign key solo si la base lo soporta
        if (Schema::getConnection()->getDriverName() !== 'sqlite') {
            Schema::table('categories', function (Blueprint $table) {
                $table->foreign('parent_id')
                      ->references('id')
                      ->on('categories')
                      ->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};

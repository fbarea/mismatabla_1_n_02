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
            $table->text('category_description');
 
            // Clave foranea autorreferenciada
            $table->foreignId('parent_id')
            ->nullable()
            ->constrained('categories')
            ->onDelete('cascade');
             
            $table->timestamps();
            $table->softDeletes();
             
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};

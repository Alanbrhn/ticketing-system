<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('icon')->nullable();
            $table->string('url')->nullable();
            $table->boolean('is_dropdown')->default(false);
            $table->foreignId('parent_id')->nullable()->constrained('menus')->cascadeOnDelete();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        
            // Pastikan tabel menggunakan InnoDB
            $table->engine = 'InnoDB';
        });
    }

    public function down()
    {
        Schema::dropIfExists('menus');
    }
};

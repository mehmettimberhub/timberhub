<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('products', static function (Blueprint $table) {
            $table->id();
            $table->enum('species', ['pine', 'spruce', 'fir', 'birch', 'apple']);
            $table->enum('grading_system', ['nordic_blue', 'tegernseer']);
            $table->enum('grading', ['A1', 'A2', 'A3', 'A4', 'B1', 'O', 'I', 'II', 'III', 'IV', 'V']);
            $table->enum('dying_method', ['fresh', 'kiln_dried', 'air_dried']);
            $table->enum('treatment', ['heat', 'anti_stain'])->nullable();
            $table->timestamps();

            $table->unique(['species', 'grading_system', 'grading', 'dying_method', 'treatment'], 'product_attributes_unique');
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};

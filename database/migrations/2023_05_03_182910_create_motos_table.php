<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('motos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('name');
            $table->text('model');
            $table->text('year');
            $table->text('hp');
            $table->text('color');
            $table->text('image')->nullable();
            $table->foreignId('category_id')->constrained('categories');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('motos');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('teacher_id');
            $table->string('max_pupils')->default(0);
            $table->string('class_name');
            $table->string('status')->default('active');
            $table->string('decription')->nullable();
            $table->string('class_key');
            $table->string('icon')->default('https://source.unsplash.com/QAB-WJcbgJk/60x60');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clas');
    }
}

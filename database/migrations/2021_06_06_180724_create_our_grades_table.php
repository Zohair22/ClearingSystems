<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOurGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('our_grades', function (Blueprint $table) {
            $table->id();
            $table->string('grade');
            $table->integer('from');
            $table->integer('to');
            $table->timestamps();
            $table->unique(['grade','from','to'],'grades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('our_grades');
    }
}

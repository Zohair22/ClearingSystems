<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradeSystemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grade_systems', function (Blueprint $table) {
            $table->id();
            $table->string('grade');
            $table->integer('from');
            $table->integer('to');
            $table->foreignId('uni_id')->constrained('collages')->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['grade','uni_id']);
            $table->unique(['from','to']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grade_systems');
    }
}

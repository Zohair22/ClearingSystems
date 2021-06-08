<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectMobilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subject_mobilities', function (Blueprint $table) {
            $table->id();
            $table->string('grade');
            $table->foreignId('stu_id')->nullable()->constrained('students')->cascadeOnDelete();
            $table->foreignId('sub_id')->constrained('subjects')->cascadeOnDelete();
            $table->foreignId('mobility_id')->constrained('mobilities')->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['stu_id','sub_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subject_mobilities');
    }
}

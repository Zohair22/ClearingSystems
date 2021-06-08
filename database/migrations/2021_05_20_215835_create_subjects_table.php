<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->integer('code');
            $table->integer('title')->default(0);
            $table->string('name');
            $table->longText('description');
            $table->integer('chr');
            $table->foreignId('uni_id')->constrained('collages')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['code','title','uni_id'],'SubCode');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subjects');
    }
}

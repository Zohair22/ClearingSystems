<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOurSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('our_subjects', function (Blueprint $table) {
            $table->id();
            $table->integer('code');
            $table->integer('title')->default(0);
            $table->string('name');
            $table->integer('chr');
            $table->longText('description')->nullable();
            $table->foreignId('doctor')->constrained('users')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['code','title'],'SubCode');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('our_subjects');
    }
}

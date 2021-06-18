<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMobilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobilities', function (Blueprint $table) {
            $table->id();
            $table->boolean('acceptable')->nullable();
            $table->boolean('reason')->nullable();
            $table->foreignId('confirm_id')->constrained('confirmations')->cascadeOnDelete();
            $table->foreignId('ours_id')->constrained('our_subjects')->cascadeOnDelete();
            $table->foreignId('admin')->nullable()->constrained('users')->cascadeOnDelete();
            $table->foreignId('doctor')->nullable()->constrained('users')->cascadeOnDelete();
            $table->foreignId('teacher')->nullable()->constrained('users')->cascadeOnDelete();
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
        Schema::dropIfExists('mobilities');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->id()->startingValue(1001);;
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->string('title', 100);
            $table->text('description')->nullable();
            $table->tinyInteger('servings')->unsigned()->nullable();
            $table->string('yield', 100)->nullable();
            $table->smallInteger('prep_time')->unsigned()->nullable();
            $table->smallInteger('cook_time')->unsigned()->nullable();
            $table->json('ingredients')->nullable();
            $table->json('directions')->nullable();
            $table->json('notes')->nullable();
            $table->timestamps();

            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};

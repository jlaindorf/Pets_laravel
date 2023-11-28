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
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('race_id');
            $table->unsignedBigInteger('specie_id');
            $table->string('name', 150);
            $table->integer('age')->nullable();
            $table->float('weight')->nullable();
            $table->enum('size', ['SMALL', 'MEDIUM', 'LARGE', 'EXTRA_LARGE']);
            $table->timestamps();
            $table->foreign('race_id')->references('id')->on('races');
            $table->foreign('specie_id')->references('id')->on('species');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};

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
        Schema::create('solicitations_documents', function (Blueprint $table) {
            $table->uuid('id'); //cria id aleatorio
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients');

            $table->unsignedBigInteger('cpf')->nullable();
            $table->foreign('cpf')->references('id')->on('files');

            $table->unsignedBigInteger('rg')->nullable();
            $table->foreign('rg')->references('id')->on('files');

            $table->unsignedBigInteger('document_adress')->nullable();
            $table->foreign('document_adress')->references('id')->on('files');

            $table->unsignedBigInteger('term_adoption')->nullable();
            $table->foreign('term_adoption')->references('id')->on('files');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitations_documents');
    }
};

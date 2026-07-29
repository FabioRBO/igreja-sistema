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
        Schema::create('people', function (Blueprint $table) {
            $table->id();

            $table->string('nome');
            $table->string('cpf',14)->nullable()->unique();

            $table->date('nascimento')->nullable();

            $table->enum('sexo',['M','F'])->nullable();

            $table->string('estado_civil')->nullable();

            $table->string('telefone')->nullable();
            $table->string('whatsapp')->nullable();

            $table->string('email')->nullable();

            $table->string('cep')->nullable();
            $table->string('logradouro')->nullable();
            $table->string('numero')->nullable();
            $table->string('bairro')->nullable();
            $table->string('cidade')->nullable();
            $table->string('estado',2)->nullable();

            $table->string('foto')->nullable();

            $table->boolean('ativo')->default(true);

            $table->text('observacoes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('people');
    }
};

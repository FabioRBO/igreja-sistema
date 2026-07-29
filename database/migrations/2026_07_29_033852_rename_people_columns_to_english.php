<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $this->renameColumnIfNeeded('people', 'nome', 'name');
        $this->renameColumnIfNeeded('people', 'nascimento', 'birth_date');
        $this->renameColumnIfNeeded('people', 'sexo', 'gender');
        $this->renameColumnIfNeeded('people', 'estado_civil', 'marital_status');
        $this->renameColumnIfNeeded('people', 'telefone', 'phone');
        $this->renameColumnIfNeeded('people', 'cep', 'zip_code');
        $this->renameColumnIfNeeded('people', 'logradouro', 'street');
        $this->renameColumnIfNeeded('people', 'numero', 'number');
        $this->renameColumnIfNeeded('people', 'bairro', 'neighborhood');
        $this->renameColumnIfNeeded('people', 'cidade', 'city');
        $this->renameColumnIfNeeded('people', 'estado', 'state');
        $this->renameColumnIfNeeded('people', 'foto', 'photo');
        $this->renameColumnIfNeeded('people', 'ativo', 'is_active');
        $this->renameColumnIfNeeded('people', 'observacoes', 'notes');
    }

    public function down(): void
    {
        $this->renameColumnIfNeeded('people', 'name', 'nome');
        $this->renameColumnIfNeeded('people', 'birth_date', 'nascimento');
        $this->renameColumnIfNeeded('people', 'gender', 'sexo');
        $this->renameColumnIfNeeded('people', 'marital_status', 'estado_civil');
        $this->renameColumnIfNeeded('people', 'phone', 'telefone');
        $this->renameColumnIfNeeded('people', 'zip_code', 'cep');
        $this->renameColumnIfNeeded('people', 'street', 'logradouro');
        $this->renameColumnIfNeeded('people', 'number', 'numero');
        $this->renameColumnIfNeeded('people', 'neighborhood', 'bairro');
        $this->renameColumnIfNeeded('people', 'city', 'cidade');
        $this->renameColumnIfNeeded('people', 'state', 'estado');
        $this->renameColumnIfNeeded('people', 'photo', 'foto');
        $this->renameColumnIfNeeded('people', 'is_active', 'ativo');
        $this->renameColumnIfNeeded('people', 'notes', 'observacoes');
    }

    private function renameColumnIfNeeded(
        string $table,
        string $oldColumn,
        string $newColumn
    ): void {
        if (
            Schema::hasColumn($table, $oldColumn) &&
            ! Schema::hasColumn($table, $newColumn)
        ) {
            Schema::table($table, function (Blueprint $blueprint) use (
                $oldColumn,
                $newColumn
            ) {
                $blueprint->renameColumn($oldColumn, $newColumn);
            });
        }
    }
};
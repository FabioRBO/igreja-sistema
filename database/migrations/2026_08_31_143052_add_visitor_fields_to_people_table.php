<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('people', function (Blueprint $table) {

            if (! Schema::hasColumn('people', 'is_visitor')) {
                $table->boolean('is_visitor')
                    ->default(false)
                    ->after('id');
            }

            if (! Schema::hasColumn('people', 'visit_date')) {
                $table->date('visit_date')
                    ->nullable()
                    ->after('is_visitor');
            }

            if (! Schema::hasColumn('people', 'address_type')) {
                $table->string('address_type', 30)
                    ->nullable()
                    ->after('visit_date');
            }

        });
    }

    public function down(): void
    {
        Schema::table('people', function (Blueprint $table) {

            if (Schema::hasColumn('people', 'address_type')) {
                $table->dropColumn('address_type');
            }

            if (Schema::hasColumn('people', 'visit_date')) {
                $table->dropColumn('visit_date');
            }

            if (Schema::hasColumn('people', 'is_visitor')) {
                $table->dropColumn('is_visitor');
            }

        });
    }
};

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
        Schema::table('criterias', function (Blueprint $table) {

            $table->foreignId('exposure_id')
                  ->nullable()
                  ->after('contest_id')
                  ->constrained('exposures')
                  ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('criterias', function (Blueprint $table) {

            $table->dropForeign(['exposure_id']);
            $table->dropColumn('exposure_id');

        });
    }
};
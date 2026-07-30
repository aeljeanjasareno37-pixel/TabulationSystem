<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('criterias', function (Blueprint $table) {

            $table->decimal('minimum_score',5,2)
                  ->default(0);

            $table->decimal('maximum_score',5,2)
                  ->default(100);

            $table->integer('sort_order')
                  ->default(0);

        });
    }


    public function down(): void
    {
        Schema::table('criterias', function (Blueprint $table) {

            $table->dropColumn([
                'minimum_score',
                'maximum_score',
                'sort_order'
            ]);

        });
    }
};
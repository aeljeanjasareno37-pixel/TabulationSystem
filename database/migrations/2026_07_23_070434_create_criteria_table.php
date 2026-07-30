<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('criterias', function (Blueprint $table) {

            $table->id();


            // Criteria belongs to Exposure
            $table->foreignId('exposure_id')
                  ->constrained()
                  ->onDelete('cascade');


            $table->string('name');


            // Percentage weight
            $table->decimal('percentage', 5, 2);


            // Score range
            $table->decimal('minimum_score', 5, 2)
                  ->default(0);

            $table->decimal('maximum_score', 5, 2)
                  ->default(100);


            // Ordering of criteria
            $table->integer('sort_order')
                  ->default(0);


            // Enable / disable criteria
            $table->boolean('is_active')
                  ->default(true);


            $table->timestamps();

        });
    }


    public function down(): void
    {
        Schema::dropIfExists('criterias');
    }
};
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
    Schema::create('exposures', function (Blueprint $table) {
        $table->id();

        $table->foreignId('contest_id')->constrained()->onDelete('cascade');

        $table->string('name');

        $table->integer('order')->default(1);

        $table->boolean('is_final')->default(false);

        $table->decimal('carry_over_percentage', 5, 2)->default(0);

        $table->integer('top_n')->nullable();

        $table->boolean('is_locked')->default(false);

        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exposures');
    }
};

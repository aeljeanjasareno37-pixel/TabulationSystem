<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('scores', function (Blueprint $table) {

            $table->id();

            $table->foreignId('contest_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->foreignId('exposure_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->foreignId('contestant_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->foreignId('judge_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->foreignId('criteria_id')
                  ->nullable()
                  ->constrained()
                  ->nullOnDelete();

            $table->decimal('score', 8, 2);

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scores');
    }
};
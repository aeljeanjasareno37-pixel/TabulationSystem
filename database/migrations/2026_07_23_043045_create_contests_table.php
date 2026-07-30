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
        Schema::create('contests', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->enum('contest_type', ['single', 'double', 'group']);
            $table->integer('judge_count');
            $table->integer('contestant_count');

            $table->string('tabulator_name')->nullable();
            $table->string('logo')->nullable();
            $table->string('pageant_logo')->nullable();

            $table->boolean('is_active')->default(false);
            $table->boolean('is_completed')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contests');
    }
};
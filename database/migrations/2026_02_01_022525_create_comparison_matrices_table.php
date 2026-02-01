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
        Schema::create('comparison_matrices', function (Blueprint $table) {
            $table->id();
        
            $table->foreignId('criteria_1_id')->constrained('criterias')->cascadeOnDelete();
            $table->foreignId('criteria_2_id')->constrained('criterias')->cascadeOnDelete();
            $table->double('nilai');
            $table->timestamps();

            $table->unique(['criteria_1_id', 'criteria_2_id']);
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comparison_matrices');
    }
};

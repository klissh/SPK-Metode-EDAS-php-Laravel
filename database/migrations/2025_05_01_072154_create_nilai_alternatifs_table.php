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
        Schema::create('nilai_alternatifs', function (Blueprint $table) {
            $table->id();
            $table->string('alternatif_code');
            $table->string('kriteria_code');
            $table->foreignId('sub_kriteria_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        
            $table->foreign('alternatif_code')->references('code')->on('alternatifs')->onDelete('cascade');
            $table->foreign('kriteria_code')->references('code')->on('kriterias')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai_alternatifs');
    }
};

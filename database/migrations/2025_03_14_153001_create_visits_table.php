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
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('researcher_id')->constrained()->cascadeOnDelete();
            $table->date('visit_date');
            $table->foreignId('group_id')->constrained()->cascadeOnDelete();
            $table->string('archives_group')->nullable();
            $table->string('accession_no')->nullable();
            $table->foreignId('copy_type_id')->constrained('copy_types')->cascadeOnDelete();
            $table->integer('no_of_pages')->default(0);
            $table->string('fees');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};

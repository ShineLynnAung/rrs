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
            $table->foreignId('researcher_id')->constrained()->onDelete('cascade');
            $table->date('visit_date');
            $table->foreignId('group_id')->constrained()->onDelete('cascade');
            $table->string('archives_group');
            $table->string('accessing_no');
            $table->foreignId('copy_type_id')->constrained()->onDelete('cascade');
            $table->string('no_of_pages');
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

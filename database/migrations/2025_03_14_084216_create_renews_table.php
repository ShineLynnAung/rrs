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
        Schema::create('renews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('researcher_id')->constrained()->onDelete('cascade');
            $table->date('renew_date');
            $table->date('expire_date');
            $table->string('title');
            $table->text('attach');
            $table->string('created_by');
            $table->string('updated_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('renews');
    }
};

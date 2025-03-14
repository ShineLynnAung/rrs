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
        Schema::create('researchers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('photo')->nullable();
            $table->text('nrc_code');
            $table->text('nrc_front')->nullable();
            $table->text('nrc_back')->nullable();
            $table->foreignId('country_id')->constrained()->onDelete('cascade');
            $table->date('dob')->nullable();
            $table->string('gender');
            $table->text('current_address');
            $table->text('permanent_address');
            $table->string('designation');
            $table->foreignId('organization_id')->constrained()->onDelete('cascade');
            $table->text('department');
            $table->foreignId('researcher_type_id')->constrained()->onDelete('cascade');
            $table->date('registration_date');
            $table->date('expire_date');
            $table->text('member_no');
            $table->string('registration_fees');
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
        Schema::dropIfExists('researchers');
    }
};

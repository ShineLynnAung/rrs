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
        $table->string('nrc_or_passport_no')->unique();
        $table->text('nrc_front')->nullable();
        $table->text('nrc_back')->nullable();
        $table->foreignId('country_id')->constrained();
        $table->date('dob');
        $table->enum('gender', ['Male', 'Female', 'Other']);
        $table->text('current_address');
        $table->text('permanent_address');
        $table->string('designation')->nullable();
        $table->string('organization_id');
        $table->string('department')->nullable();
        $table->foreignId('researcher_type_id')->constrained();
        $table->date('registration_date');
        $table->date('expire_date');
        $table->string('member_no');
        $table->string('registration_fees');
        $table->string('title')->nullable();
        $table->string('attach')->nullable();
        $table->string('created_by')->nullable();
        $table->string('updated_by')->nullable();
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

<?php

use App\Models\Standard;
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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('student_id')->unique();
            $table->foreignIdFor(Standard::class);
            $table->string('name');
            $table->date('date_of_birth');
            $table->string('gender');
            $table->string('status');
            $table->string('race');
            $table->string('religion');
            $table->string('nationality');
            $table->string('ic_no');
            $table->string('address_1');
            $table->string('address_2');
            $table->string('home_phone')->nullable();
            $table->string('mobile_phone');
            $table->string('email')->unique();
            $table->json('vitals')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};

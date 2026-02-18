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
        Schema::create('deads', function (Blueprint $table) {
            $table->id();
            $table->string('dead_code')->unique()->comment('고인코드');
            $table->string('name')->comment('고인명');
            $table->string('category')->comment('구분(하늘누리관, 자연장)');
            $table->string('location_hall')->nullable()->comment('하늘누리관-관');
            $table->string('location_area')->nullable()->comment('자연장-구역');
            $table->string('location_row')->nullable()->comment('열');
            $table->string('location_num')->nullable()->comment('번호');
            $table->date('death_date')->comment('기일');
            $table->date('burial_date')->comment('안치일');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deads');
    }
};

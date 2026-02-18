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
        Schema::create('brochure_applications', function (Blueprint $table) {
            $table->id();
            $table->string('member_id')->nullable();
            $table->string('name');
            $table->string('email');
            $table->enum('status', ['미발송', '발송완료'])->default('미발송');
            $table->dateTime('sent_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brochure_applications');
    }
};

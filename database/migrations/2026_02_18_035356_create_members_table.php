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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique()->comment('아이디');
            $table->string('password')->comment('비밀번호');
            $table->string('name')->comment('이름');
            $table->string('phone')->nullable()->comment('핸드폰번호');
            $table->string('email')->nullable()->comment('이메일');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};

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
        Schema::create('letters', function (Blueprint $table) {
            $table->id();
            $table->string('username')->comment('작성자 ID');
            $table->text('content')->comment('내용 (최대 600자)');
            $table->string('author_description')->comment('작성자칭 (예: 아들, 딸)');
            $table->char('is_private', 1)->default('N')->comment('비밀글 여부 (Y/N)');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('letters');
    }
};

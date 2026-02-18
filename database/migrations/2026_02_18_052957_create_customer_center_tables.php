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
        // 공지사항
        Schema::create('notices', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->foreignId('author_id')->constrained('admins');
            $table->integer('view_count')->default(0);
            $table->timestamps();
        });

        Schema::create('notice_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('notice_id')->constrained()->onDelete('cascade');
            $table->string('original_name');
            $table->string('stored_name');
            $table->string('file_path');
            $table->timestamps();
        });

        // 1:1 상담
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('username')->comment('작성자 ID');
            $table->string('email')->nullable();
            $table->string('title');
            $table->text('content');
            $table->string('status')->default('미답변')->comment('미답변, 답변완료');
            $table->timestamps();
        });

        Schema::create('inquiry_replies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inquiry_id')->constrained()->onDelete('cascade');
            $table->foreignId('admin_id')->constrained('admins');
            $table->string('title');
            $table->text('content');
            $table->timestamps();
        });

        Schema::create('inquiry_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inquiry_reply_id')->constrained()->onDelete('cascade');
            $table->string('original_name');
            $table->string('stored_name');
            $table->string('file_path');
            $table->timestamps();
        });

        // 자료실
        Schema::create('reference_rooms', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->foreignId('author_id')->constrained('admins');
            $table->timestamps();
        });

        Schema::create('reference_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reference_room_id')->constrained()->onDelete('cascade');
            $table->string('original_name');
            $table->string('stored_name');
            $table->string('file_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_center_tables');
    }
};

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
        // Messages table - to store chat messages
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('receiver_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('sender_id')->constrained('users')->onDelete('cascade');
            $table->unique(['receiver_id' , 'sender_id']);
            $table->timestamps();
        });
        Schema::create('messages', function(Blueprint $table){
            $table->id();
            $table->foreignId('chat_id')->constrained('chats')->onDelete('cascade');
            $table->foreignId('sender_id')->constrained('users')->onDelete('cascade');
            $table->text('content');
            $table->enum('status', ['sent', 'delivered', 'read'])->default('sent');
            $table->timestamp(column: 'read_at')->nullable();
            $table->timestamps();
        });
        // Message attachments - for files/images in chats
        Schema::create('message_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chat_id')->constrained('messages')->onDelete('cascade');
            $table->string('file_path');
            $table->string('file_type'); // e.g., image/jpeg, application/pdf
            $table->integer('file_size'); // in bytes
            $table->timestamps();
        });
    }
};

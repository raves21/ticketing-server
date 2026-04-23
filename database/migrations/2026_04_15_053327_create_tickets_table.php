<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->foreignId('sender_office_id')->references('id')->on('offices');
            $table->foreignId('recipient_office_id')->references('id')->on('offices');
            $table->foreignId('creator_id')->nullable()->references('id')->on('users')->nullOnDelete();
            $table->string('title');
            $table->text('description');
            $table->enum('status', [
                'pending',
                'in_progress',
                'on_hold',
                'awaiting_approval',
                'rejected',
                'cancelled',
                'completed'
            ])->default('pending');
            $table->enum('priority_level', ['routine', 'urgent', 'emergency']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};

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
            $table->foreignId('sender_unit_id')->nullable()->constrained('units')->nullOnDelete();

            //a ticket can be re-assigned to other sub-units within a root unit. current_unit_id is the unit that is currently responsible for the ticket.
            //when it is re-assigned to a new unit, the new unit will be the current_unit_id,
            $table->foreignId('current_unit_id')->nullable()->constrained('units')->nullOnDelete();
            $table->foreignId('recipient_unit_id')->nullable()->constrained('units')->nullOnDelete();
            $table->foreignId('creator_id')->nullable()->constrained('users')->nullOnDelete();
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

            $table->index(['title']);
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

<?php

use App\Models\Room;
use App\Models\User;
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

        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->timestamp('start_datetime');
            $table->timestamp('end_datetime');
            $table->enum('status',['pending' , 'confirmed' , 'cancelled'])->default('pending');
            $table->text('notes');
            $table->foreignIdFor(Room::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};

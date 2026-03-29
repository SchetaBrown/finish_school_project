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
        Schema::create('olympiad_orders', function (Blueprint $table) {
            $table->id();

            $table->float('score')->default(0);
            $table->integer('place')->nullable();
            $table->boolean('is_receive')->nullable();
            $table->boolean('is_hostel')->nullable();
            $table->date('arrival_date')->nullable();
            $table->date('departure_date')->nullable();

            $table
                ->foreignId('participant_id')
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table
                ->foreignId('manager_id')
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table
                ->foreignId('olympiad_id')
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('olympiad_applications');
    }
};

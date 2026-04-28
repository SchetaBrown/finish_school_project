<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('olympiad_orders', function (Blueprint $table) {
            $table->id();

            $table->float('score')->default(0);
            $table->integer('place')->nullable();
            $table->boolean('is_education_manager_accept')->default(true);
            $table->text('reject_message')->nullable();
            $table->boolean('is_olympiad_manager_accept')->default(false);
            $table->boolean('is_hostel')->default(false);
            $table->dateTime('arrival_date')->nullable();
            $table->dateTime('departure_date')->nullable();

            $table
                ->foreignId('participant_id')
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table
                ->foreignId('education_manager_id')
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table
                ->foreignId('olympiad_id')
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table
                ->foreignId('olympiad_order_status_id')
                ->default(1)
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

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
        Schema::create('participants', function (Blueprint $table) {
            $table->id();

            $table->date('birth_date');
            $table->integer('cours_number');
            $table->boolean('is_hostel')->nullable();
            $table->date('arrival_date')->nullable();
            $table->date('departure_date')->nullable();

            $table
                ->foreignId('user_id')
                ->constrained();
            $table
                ->foreignId('education_school_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table
                ->foreignId('education_direction_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table
                ->foreignId('attached_manager_id')
                ->nullable()
                ->references('id')
                ->on('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participants');
    }
};

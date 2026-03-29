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
        Schema::create('olympiads', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->dateTime('register_start_date');
            $table->dateTime('register_end_date');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('player_count');

            $table
                ->foreignId('olympiad_status_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table
                ->foreignId('olympiad_manager_id')
                ->references('id')
                ->on('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table
                ->foreignId('olympiad_direction_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();


            $table->index(['slug', 'title']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('olympiads');
    }
};

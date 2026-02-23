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
            $table->text('description');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('player_count');
            $table->integer('player_limit');
            $table->string('slug');

            $table
                ->foreignId('olympiad_status_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table
                ->foreignId('olympiad_direction_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->index(['slug']);

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

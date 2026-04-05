<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('education_schools', function (Blueprint $table) {
            $table->id();

            $table->string('full_name')->unique();
            $table->string('short_name')->unique();
            $table->string('inn')->unique();
            $table->string('phone')->unique();
            $table->string('director_surname');
            $table->string('director_name');
            $table->string('director_patronymic');
            $table->string('email')->unique()->nullable();
            $table->integer('max_player_count')->default(5);

            $table
                ->foreignId('city_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('education_schools');
    }
};

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
        Schema::create('education_schools', function (Blueprint $table) {
            $table->id();

            $table->string('full_name');
            $table->string('short_name');
            $table->string('inn');
            $table->string('phone');
            $table->string('director_surname');
            $table->string('director_name');
            $table->string('director_patronymic');
            $table->string('email')->unique()->nullable();

            $table
                ->foreignId('city_id')
                ->constrained()
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
        Schema::dropIfExists('education_schools');
    }
};

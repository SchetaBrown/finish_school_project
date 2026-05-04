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
        Schema::create('olympiad_documents', function (Blueprint $table) {
            $table->id();

            $table->enum('type', ['docx', 'pdf']);
            $table->string('path');
            $table
                ->foreignId('olympiad_order_id')
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade');
            ;
            $table
                ->foreignId('participant_id')
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade');
            ;

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('olympiad_documents');
    }
};

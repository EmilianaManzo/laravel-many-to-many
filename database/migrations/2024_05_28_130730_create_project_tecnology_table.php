<?php

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
        Schema::create('project_tecnology', function (Blueprint $table) {

            // colonna di relazione con project
            $table->unsignedBigInteger('project_id');
            // FK su questa colonna
            $table->foreign('project_id')
                    ->references('id')
                    ->on('projects')
                    ->cascadeOnDelete();

            // colonna di relazione con tecnology
            $table->unsignedBigInteger('tecnology_id');
            // FK su questa colonna
            $table->foreign('tecnology_id')
                    ->references('id')
                    ->on('tecnologies')
                    ->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_tecnology');
    }
};

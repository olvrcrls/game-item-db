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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable(false);
            $table->string('game_id', 255)->nullable();
            $table->string('image', 255)->nullable();
            $table->longText('description');
            $table->json('attributes')->nullable();

            $table->string('type', 255)->nullable();
            $table->string('rarity', 100)->nullable();
            
            $table->boolean('deprecated')->default(false);

            $table->index([
                'name', 'game_id'
            ]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};

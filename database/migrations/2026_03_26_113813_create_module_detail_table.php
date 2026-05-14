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
        Schema::create('module_detail', function (Blueprint $table) {
            $table->id();            
            $table->foreignId('module_id')
                ->references('id')
                ->on('module')
                ->onDelete('cascade');
            $table->text('title');
            $table->longText('content');
            $table->integer('order')->default(0);
            $table->boolean('has_image')->default(false);
            $table->boolean('has_video')->default(false);
            $table->boolean('has_game')->default(false);
            $table->string('image_url')->nullable();
            $table->string('video_url')->nullable();
            $table->enum('game_type', [
                'quiz',
                'memory',
                'matching'            
            ])->nullable();            
            $table->string('game_file')->nullable();            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('module_detail');
    }
};

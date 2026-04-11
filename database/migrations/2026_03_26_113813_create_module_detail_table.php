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
            $table->longText('content');
            $table->boolean('has_image')->default(false);
            $table->boolean('has_video')->default(false);
            $table->string('image')->nullable();
            $table->string('video')->nullable();
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

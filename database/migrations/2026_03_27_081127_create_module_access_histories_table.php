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
        Schema::create('module_access_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreignId('module_id')
                ->references('id')
                ->on('module')
                ->onDelete('cascade');
            $table->enum('type', [
                'children',
                'parent'
            ])->default('parent');
            $table->date('accessed_at')->useCurrent();
            $table->unique('module_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('module_access_histories');
    }
};

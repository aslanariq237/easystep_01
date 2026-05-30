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
        Schema::table('module_access_histories', function (Blueprint $table) {
            // 1. Hapus foreign key dulu
            $table->dropForeign(['module_id']);

            // 2. Hapus unique index yang salah
            $table->dropUnique('module_access_histories_module_id_unique');

            // 3. Tambah unique yang benar (user_id + module_id)
            $table->unique(['user_id', 'module_id']);

            // 4. Tambahkan kembali foreign key
            $table->foreign('module_id')
                  ->references('id')
                  ->on('module')
                  ->onDelete('cascade');
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('module_access_histories', function (Blueprint $table) {
            $table->dropForeign(['module_id']);
            $table->dropUnique(['user_id', 'module_id']);
            $table->unique('module_id');
            $table->foreign('module_id')
                  ->references('id')
                  ->on('module')
                  ->onDelete('cascade');
        });
    }
};

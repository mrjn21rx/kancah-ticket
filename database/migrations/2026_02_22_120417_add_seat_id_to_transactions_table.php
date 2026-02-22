<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transactions', function (Blueprint $table) {

            $table->foreignId('seat_id')
                  ->nullable()
                  ->constrained()
                  ->onDelete('cascade');

        });
    }

    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {

            $table->dropForeign(['seat_id']);
            $table->dropColumn('seat_id');

        });
    }
};
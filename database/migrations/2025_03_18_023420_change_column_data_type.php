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

        Schema::table('venues', function (Blueprint $table) {
            $table->dropColumn('venue_max_capacity');
            $table->integer('venue_max_capacity')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('venues', function (Blueprint $table) {
            $table->dropColumn('venue_max_capacity');
            $table->string('venue_max_capacity')->nullable();
        });
    }
};

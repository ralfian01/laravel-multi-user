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
        Schema::create('privilege', function (Blueprint $table) {
            $table->integer('pp_id')->autoIncrement();
            $table->string('pp_code', 30)->nullable(false)->unique();
            $table->string('pp_description', 100);
            $table->dateTime('pp_createdAt')->useCurrent();
            $table->dateTime('pp_updatedAt')->useCurrentOnUpdate()->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('privilege');
    }
};

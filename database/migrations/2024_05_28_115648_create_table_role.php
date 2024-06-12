<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Create role table
        Schema::create('role', function (Blueprint $table) {
            $table->integer('pr_id')->autoIncrement();
            $table->string('pr_code', 30)->nullable(false)->unique();
            $table->string('pr_name', 100);
            $table->dateTime('pr_createdAt')->useCurrent();
            $table->dateTime('pr_updatedAt')->useCurrentOnUpdate()->nullable()->default(null);
        });

        // Create role privilege table
        Schema::create('role__privilege', function (Blueprint $table) {
            $table->integer('prp_id')->autoIncrement();
            $table->integer('pr_id')->nullable(false);
            $table->foreign('pr_id')->references('pr_id')->on('role')
                ->onDelete('cascade')
                ->onUpdate('no action');
            $table->integer('pp_id')->nullable(false);
            $table->foreign('pp_id')->references('pp_id')->on('privilege')
                ->onDelete('cascade')
                ->onUpdate('no action');
            $table->unique(['pr_id', 'pp_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role');
        Schema::dropIfExists('role__privilege');
    }
};

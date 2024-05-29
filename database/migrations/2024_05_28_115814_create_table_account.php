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
        // Create account table
        Schema::create('account', function (Blueprint $table) {
            $table->integer('pa_id')->autoIncrement();
            $table->string('pa_uuid', 50)->nullable(false);
            $table->string('pa_username', 100)->nullable(false);
            $table->string('pa_password', 100)->nullable(true);
            $table->integer('pr_id')->nullable(false);
            $table->foreign('pr_id')->references('pr_id')->on('role')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->boolean('pa_deletable')->default(true)->nullable(false);
            $table->boolean('pa_statusActive')->default(false)->nullable(false);
            $table->boolean('pa_statusDelete')->default(false)->nullable(false);

            $table->dateTime('pa_createdAt')->useCurrent();
            $table->dateTime('pa_updatedAt')->useCurrentOnUpdate()->nullable()->default(null);
        });

        // Create account privilege table
        Schema::create('account__privilege', function (Blueprint $table) {
            $table->integer('pap_id')->autoIncrement();
            $table->integer('pa_id')->nullable(false);
            $table->foreign('pa_id')->references('pa_id')->on('account')
                ->onDelete('cascade')
                ->onUpdate('no action');

            $table->integer('pp_id')->nullable(false);
            $table->foreign('pp_id')->references('pp_id')->on('privilege')
                ->onDelete('cascade')
                ->onUpdate('no action');
        });

        // Create account metadata table
        Schema::create('account__meta', function (Blueprint $table) {
            $table->integer('pam_id')->autoIncrement();
            $table->string('pam_code', 30)->nullable(false);
            $table->string('pam_value', 100)->nullable(true)->default(null);

            $table->integer('pa_id')->nullable(false);
            $table->foreign('pa_id')->references('pa_id')->on('account')
                ->onDelete('cascade')
                ->onUpdate('no action');

            $table->dateTime('pa_createdAt')->useCurrent();
            $table->dateTime('pa_expiredAt')->nullable(true);
        });

        // Create account table view
        // Here
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account');
        Schema::dropIfExists('account__privilege');
        Schema::dropIfExists('account__meta');
    }
};

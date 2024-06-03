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

        // Create role table view
        $prefix = DB::getTablePrefix();
        $driver = DB::getDriverName();

        switch ($driver) {
            case 'pgsql':
                // 
                break;

            case 'mysql':
            case 'mariadb':
                DB::statement("DROP VIEW IF EXISTS {$prefix}role__vw");
                DB::statement("
                    CREATE VIEW {$prefix}role__vw AS
                    SELECT
                        {$prefix}role.pr_id AS prv_id,
                        {$prefix}role.pr_code AS prv_code,
                        {$prefix}role.pr_name AS prv_name,
                        IFNULL(prpv.privilege, '[]') AS prv_privilege
                    FROM (
                        {$prefix}role
                        LEFT JOIN (
                            SELECT
                                prp.pr_id AS pr_id,
                                CONCAT('[',
                                    GROUP_CONCAT('\"', pp.pp_code, '\"'),
                                ']') AS privilege
                            FROM {$prefix}role__privilege prp
                            LEFT JOIN {$prefix}privilege pp
                            ON pp.pp_id = prp.pp_id
                            GROUP BY prp.pr_id
                        ) prpv
                        ON prpv.pr_id = {$prefix}role.pr_id
                    )
                    ORDER BY {$prefix}role.pr_id
                ");
                break;

            case 'sqlite':
                // 
                break;
            default:
                throw new Exception("Unsupported database driver");
        }
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

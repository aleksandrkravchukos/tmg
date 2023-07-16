<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::connection('mysql_test')->statement('CREATE DATABASE IF NOT EXISTS `tmg_test`');
        DB::connection('mysql_test')->statement('SET FOREIGN_KEY_CHECKS=0');
        DB::connection('mysql_test')->beginTransaction();

        $tables = ['users', 'migrations'];

        foreach ($tables as $table) {
            $query = "INSERT INTO `tmg_test`.`$table` SELECT * FROM `tmg`.`$table`";
            DB::connection('mysql_test')->statement($query);
        }

        DB::connection('mysql_test')->commit();
        DB::connection('mysql_test')->statement('SET FOREIGN_KEY_CHECKS=1');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('copy_existing_database_for_tests');
    }
};

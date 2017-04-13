<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class ModifyNavTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('navigations', function (Blueprint $table) {
            $table->integer('sort')->default(0)->after('status');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('navigations', function (Blueprint $table) {
            $table->dropColumn('sort');
        });
    }
}

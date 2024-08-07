<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNumberOfVisitorsToAccessFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('access_forms', function (Blueprint $table) {
            $table->integer('number_of_visitors')->nullable()->after('rack_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('access_forms', function (Blueprint $table) {
            $table->dropColumn('number_of_visitors');
        });
    }
}

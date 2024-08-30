<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPhotoColumnInAccessFormsTable extends Migration
{
    public function up()
{
    Schema::table('access_forms', function (Blueprint $table) {
        $table->longText('photo')->nullable()->change();
    });
}

public function down()
{
    Schema::table('access_forms', function (Blueprint $table) {
        $table->string('photo', 255)->nullable(false)->change();
    });
}

}


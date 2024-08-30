<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccessFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('access_forms', function (Blueprint $table) {
            $table->id();
            $table->string('requestor_name');
            $table->string('company_name');
            $table->string('address');
            $table->string('phone_number');
            $table->string('mobile_number');
            $table->string('email');
            $table->date('date_of_request');
            $table->timestamps();
            $table->longtext('photo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('access_forms');
    }
}

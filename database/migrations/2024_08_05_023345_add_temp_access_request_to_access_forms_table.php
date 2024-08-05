<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('access_forms', function (Blueprint $table) {
        $table->string('country')->nullable();
        $table->string('data_center')->nullable();
        $table->string('data_center_address')->nullable();
        $table->date('visit_from_date')->nullable();
        $table->time('visit_from_time')->nullable();
        $table->date('visit_to_date')->nullable();
        $table->time('visit_to_time')->nullable();
        $table->string('visit_purpose')->nullable();
        $table->boolean('permit_to_work')->nullable();
        $table->string('rack_id')->nullable();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('access_forms', function (Blueprint $table) {
            //
        });
    }
};

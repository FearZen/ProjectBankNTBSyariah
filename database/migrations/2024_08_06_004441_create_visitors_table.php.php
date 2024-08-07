<?php

// Contoh migrasi untuk tabel visitors
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorsTable extends Migration
{
    public function up()
    {
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('access_form_id');
            $table->string('visitor_name');
            $table->string('visitor_type');
            $table->string('visitor_designation');
            $table->string('visitor_company_name');
            $table->string('identity_number');
            $table->string('visitor_phone_number');
            $table->string('visitor_email');
            $table->string('vehicle_number');
            $table->timestamps();

            $table->foreign('access_form_id')->references('id')->on('access_forms')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('visitors');
    }
}


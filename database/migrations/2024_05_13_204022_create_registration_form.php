<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegristrationForm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registration_form', function (Blueprint $table) {
            $table->id('id');
            $table->string('nama');
            $table->string('username');
            $table->date('date_of_birth');
            $table->location('address');
            $table->string('religion');
            $table->string('instution');
            $table->int('phone_number');
            $table->string('field_of_experience');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatesTable extends Migration
{
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('phone_number');
            $table->string('first_name');
            $table->string('last_name');
            $table->enum('sex', ['male', 'female']);
            $table->date('date_of_birth');
            $table->string('position');
            $table->text('languages');
            $table->string('driving_license')->nullable();
            $table->string('cv')->nullable();
            $table->boolean('own_transport')->default(false);
            $table->string('is_working')->default(0);
            // 0=not working
            // 1=during recruitment
            // 2=working
            // 3=black list
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('candidates');
    }
}


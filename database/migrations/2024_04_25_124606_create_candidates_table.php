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
            $table->enum('sex', ['male', 'female', 'other']);
            $table->date('date_of_birth');
            $table->string('position');
            $table->text('language_knowledge');
            $table->boolean('driving_license')->default(false);
            $table->boolean('own_transport')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('candidates');
    }
}


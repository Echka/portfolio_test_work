<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $this->engine = 'InnoDB';

            $table->id();

            $table->string('fio', 70)->nullable(true);
            $table->timestamp('date_of_birth')->nullable(true);
            $table->string('city', 20)->nullable(true);
            $table->string('address', 70)->nullable(true);
            $table->string('phone', 20)->nullable(true);
            $table->string('email', 30)->nullable(true);
            $table->unsignedBigInteger('user_id');

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}

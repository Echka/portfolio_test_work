<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education', function (Blueprint $table) {
            $this->engine = 'InnoDB';

            $table->id();

            $table->timestamp('date_start')->nullable(true);
            $table->timestamp('date_finish')->nullable(true);
            $table->string('specialty', 50);
            $table->string('city', 20);
            $table->string('type_of_education', 20);
            $table->unsignedBigInteger('brief_id');


            $table->foreign('brief_id')->references('id')->on('briefs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('education');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_experiences', function (Blueprint $table) {
            $this->engine = 'InnoDB';

            $table->id();

            $table->timestamp('date_start')->nullable(true);
            $table->timestamp('date_finish')->nullable(true);
            $table->string('place_of_work', 50);
            $table->string('short_description', 200);
            $table->string('position', 50);
            $table->unsignedBigInteger('brief_id');
            $table->timestamps();


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
        Schema::dropIfExists('work_experiences');
    }
}

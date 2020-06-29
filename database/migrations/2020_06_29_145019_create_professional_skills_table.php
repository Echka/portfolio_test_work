<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfessionalSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professional_skills', function (Blueprint $table) {
            $this->engine = 'InnoDB';

            $table->id();

            $table->string('type_skill', 100);
            $table->text('description_skill');
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
        Schema::dropIfExists('professional_skills');
    }
}

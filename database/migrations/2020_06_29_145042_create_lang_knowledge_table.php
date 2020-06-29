<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLangKnowledgeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lang_knowledge', function (Blueprint $table) {
            $this->engine = 'InnoDB';

            $table->id();

            $table->string('language', 20);
            $table->string('level_lang', 20);
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
        Schema::dropIfExists('lang_knowledge');
    }
}

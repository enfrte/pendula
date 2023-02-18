<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('translations', function (Blueprint $table) {
            $table->id('translation_id');
            $table->char('translation_lang', 2);
            $table->string('translation', 1000);
            $table->timestamps();
            $table->unsignedBigInteger('source_sentenece_id');
            $table->foreign('source_sentenece_id')->references('source_sentenece_id')->on('source_senteneces');
            $table->unsignedBigInteger('translator_id');
            $table->foreign('translator_id')->references('translator_id')->on('translators');
            $table->comment('Sentence translations.');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('translations');
    }
};

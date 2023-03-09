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
            $table->id();
            $table->char('lang', 2);
            $table->string('translation', 1000);
            $table->timestamps();
			$table->foreignId('source_sentence_id')->constrained();
			$table->foreignId('translator_id')->constrained();
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

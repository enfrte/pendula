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
        Schema::create('source_sentences', function (Blueprint $table) {
            $table->id();
            $table->mediumInteger('grouping_index');
            $table->mediumInteger('page_num');
            $table->string('sentence_text', 1000);
            $table->timestamps();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('project_id')->constrained();
            $table->unique(['project_id', 'grouping_index', 'page_num']);
            $table->comment('The original text, broken into sentences.');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('source_sentences');
    }
};

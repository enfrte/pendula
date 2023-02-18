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
        Schema::create('translators', function (Blueprint $table) {
            $table->id('translator_id');
            $table->foreignId('user_id')->constrained();
            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')->references('project_id')->on('projects');
            $table->timestamps();
            $table->comment('Users that have the rights to translate a project. Project admin can add and remove users.');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('translators');
    }
};

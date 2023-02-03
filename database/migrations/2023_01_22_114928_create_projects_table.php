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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title', 500);
            $table->string('description', 5000)->nullable();
            $table->char('source_lang', 2);
            $table->timestamps();
            $table->foreignId('user_id')->constrained();
            $table->comment('The name and details of the text being translated.');
        });
        Schema::insert(
            'insert into users (name, email, password) values (?, ?, ?)', 
            ['leon', 'n2fole00@gmail.com', '0000']
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('cost');
            $table->integer('saved');
            $table->unsignedBigInteger('user_id');
            $table->string('currency');
            $table->string('type');
            $table->boolean('completed');
            $table->timestamps();
        });
        
        Schema::table('items', function (Blueprint $table) {
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
        Schema::dropIfExists('item');
    }
}

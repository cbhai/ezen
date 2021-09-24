<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');//->unique();
            $table->longText('description');
            $table->integer('is_master')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}

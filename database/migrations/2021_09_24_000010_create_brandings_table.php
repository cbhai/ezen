<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandingsTable extends Migration
{
    public function up()
    {
        Schema::create('brandings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('header');
            $table->string('footer');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}

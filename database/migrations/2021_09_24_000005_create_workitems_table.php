<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkitemsTable extends Migration
{
    public function up()
    {
        Schema::create('workitems', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->longText('description');
            $table->decimal('rate', 15, 2);
            $table->string('unit');
            $table->integer('is_master')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}

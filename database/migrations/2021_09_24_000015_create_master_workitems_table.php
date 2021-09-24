<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterWorkitemsTable extends Migration
{
    public function up()
    {
        Schema::create('master_workitems', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->longText('description');
            $table->string('unit');
            $table->decimal('rate', 15, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}

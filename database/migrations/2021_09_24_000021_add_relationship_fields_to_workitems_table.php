<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToWorkitemsTable extends Migration
{
    public function up()
    {
        Schema::table('workitems', function (Blueprint $table) {
            $table->unsignedBigInteger('room_id');
            $table->foreign('room_id', 'room_fk_4904699')->references('id')->on('rooms');
            $table->unsignedBigInteger('owner_id');
            $table->foreign('owner_id', 'owner_fk_4947258')->references('id')->on('users');
        });
    }
}

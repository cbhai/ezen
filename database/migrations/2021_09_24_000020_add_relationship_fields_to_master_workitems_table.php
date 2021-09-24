<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMasterWorkitemsTable extends Migration
{
    public function up()
    {
        Schema::table('master_workitems', function (Blueprint $table) {
            $table->unsignedBigInteger('room_id');
            $table->foreign('room_id', 'room_fk_4904526')->references('id')->on('master_rooms');
        });
    }
}

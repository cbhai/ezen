<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEstimateDetailsTable extends Migration
{
    public function up()
    {
        Schema::table('estimate_details', function (Blueprint $table) {
            $table->unsignedBigInteger('estimate_id');
            $table->foreign('estimate_id', 'estimate_fk_4904711')->references('id')->on('estimates');
            $table->unsignedBigInteger('room_id');
            $table->foreign('room_id', 'room_fk_4904712')->references('id')->on('rooms');
            $table->unsignedBigInteger('owner_id');
            $table->foreign('owner_id', 'owner_fk_4947259')->references('id')->on('users');
        });
    }
}

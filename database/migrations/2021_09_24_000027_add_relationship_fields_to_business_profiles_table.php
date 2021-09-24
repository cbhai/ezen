<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBusinessProfilesTable extends Migration
{
    public function up()
    {
        Schema::table('business_profiles', function (Blueprint $table) {
            $table->unsignedBigInteger('owner_id');
            $table->foreign('owner_id', 'owner_fk_4947252')->references('id')->on('users');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTermsTable extends Migration
{
    public function up()
    {
        Schema::table('terms', function (Blueprint $table) {
            $table->unsignedBigInteger('owner_id');
            $table->foreign('owner_id', 'owner_fk_4947254')->references('id')->on('users');
        });
    }
}

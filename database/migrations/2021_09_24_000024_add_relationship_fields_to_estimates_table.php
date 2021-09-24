<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEstimatesTable extends Migration
{
    public function up()
    {
        Schema::table('estimates', function (Blueprint $table) {
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id', 'customer_fk_4904636')->references('id')->on('customers');
            $table->unsignedBigInteger('owner_id');
            $table->foreign('owner_id', 'owner_fk_4947256')->references('id')->on('users');
        });
    }
}

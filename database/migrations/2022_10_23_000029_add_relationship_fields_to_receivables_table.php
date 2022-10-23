<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToReceivablesTable extends Migration
{
    public function up()
    {
        Schema::table('receivables', function (Blueprint $table) {
            $table->unsignedBigInteger('settled_by_id')->nullable();
            $table->foreign('settled_by_id', 'settled_by_fk_7514653')->references('id')->on('users');
        });
    }
}

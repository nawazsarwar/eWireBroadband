<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToOrdersTable extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('receivable_id')->nullable();
            $table->foreign('receivable_id', 'receivable_fk_7514644')->references('id')->on('receivables');
        });
    }
}

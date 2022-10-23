<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSupportCommentsTable extends Migration
{
    public function up()
    {
        Schema::table('support_comments', function (Blueprint $table) {
            $table->unsignedBigInteger('ticket_id')->nullable();
            $table->foreign('ticket_id', 'ticket_fk_7514631')->references('id')->on('support_tickets');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_7514632')->references('id')->on('users');
        });
    }
}

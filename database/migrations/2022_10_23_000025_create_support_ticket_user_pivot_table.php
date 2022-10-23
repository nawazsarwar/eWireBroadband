<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupportTicketUserPivotTable extends Migration
{
    public function up()
    {
        Schema::create('support_ticket_user', function (Blueprint $table) {
            $table->unsignedBigInteger('support_ticket_id');
            $table->foreign('support_ticket_id', 'support_ticket_id_fk_7515094')->references('id')->on('support_tickets')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_id_fk_7515094')->references('id')->on('users')->onDelete('cascade');
        });
    }
}

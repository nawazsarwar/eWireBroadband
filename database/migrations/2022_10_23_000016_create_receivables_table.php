<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceivablesTable extends Migration
{
    public function up()
    {
        Schema::create('receivables', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('financeref')->nullable();
            $table->datetime('lastupdate');
            $table->longText('description')->nullable();
            $table->string('username');
            $table->integer('subscriberid');
            $table->decimal('amount', 15, 2);
            $table->integer('settled')->nullable();
            $table->datetime('settled_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}

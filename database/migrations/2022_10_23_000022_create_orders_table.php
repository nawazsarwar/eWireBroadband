<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('parameters')->nullable();
            $table->decimal('amount', 15, 2)->nullable();
            $table->string('currency')->nullable();
            $table->string('status')->nullable();
            $table->datetime('transacted_on')->nullable();
            $table->string('narration')->nullable();
            $table->longText('response')->nullable();
            $table->string('merchant_order')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}

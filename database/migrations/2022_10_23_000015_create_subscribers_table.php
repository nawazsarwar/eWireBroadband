<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscribersTable extends Migration
{
    public function up()
    {
        Schema::create('subscribers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username')->unique();
            $table->string('firstname');
            $table->string('lastname')->nullable();
            $table->string('mobileno');
            $table->string('alternate_mobile_no')->nullable();
            $table->string('email')->unique();
            $table->string('address');
            $table->string('packagename')->nullable();
            $table->string('billingtypeid')->nullable();
            $table->string('subscriberid')->unique();
            $table->string('gstin')->nullable();
            $table->integer('status')->nullable();
            $table->datetime('expiry')->nullable();
            $table->datetime('registrationdate')->nullable();
            $table->decimal('balance', 15, 2)->nullable();
            $table->string('sub_status')->nullable();
            $table->string('remarks')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupportCommentsTable extends Migration
{
    public function up()
    {
        Schema::create('support_comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('text');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}

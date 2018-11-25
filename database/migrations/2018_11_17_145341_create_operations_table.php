<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('value');
//            $table->decimal('value', 7,2);// for future production
            $table->string('status');
            $table->string('type');
            $table->integer('sender_account_id');
            $table->integer('receiver_account_id');
            $table->timestamps();
            $table->index('status');
            $table->index('type');
            $table->index('sender_account_id');
            $table->index('receiver_account_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('operations');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExchangeRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('exchange_rates', function (Blueprint $table) {
//            $table->increments('id');
//            $table->string('sender_account_type');
//            $table->string('receiver_account_type');
//            $table->decimal('rate',7,2);
//            $table->timestamps();
//            $table->index('sender_account_type_id');
//            $table->index('receiver_account_type_id');
//        });

        /**
         * @todo sender_account_type and store '\App\Services\MoneyAccount'
         */
//        $exRate = new \App\Models\ExchangeRate();
//        $exRate->sender_account_type = ;
//        $exRate->receiver_account_type = \App\Models\AccountType::select('id')->where('code', '=', 'bonus')->first()->id;
//        $exRate->rate = 10;
//        $exRate->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exchange_rates');
    }
}

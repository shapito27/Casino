<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrizeIntervalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prize_intervals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('prize_type');
            $table->integer('from');
            $table->integer('to');
            $table->integer('modified_by');//user_id
            $table->timestamps();
            $table->index('prize_type');
            $table->index('modified_by');
        });

        \App\Services\PrizeInterval::createInterval(
            'Денежный приз будет из этого интервала',
            \App\Services\MoneyPrize::getClassName(),
            10,
            1000,
            1
        );

        \App\Services\PrizeInterval::createInterval(
            'Размер выигранных бонусов будет из этого интервала',
            \App\Services\BonusPrize::getClassName(),
            10,
            1000,
            1
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prize_intervals');
    }
}

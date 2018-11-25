<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperationTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('operation_types', function (Blueprint $table) {
//            $table->increments('id');
//            $table->string('code', 100)->unique();
//            $table->string('name', 100);
//            $table->timestamps();
//        });
//
//        $accountTypes = [
//            [
//                'name' => 'Выигрыш',
//                'code' => 'win'
//            ],
//            [
//                'name' => 'Конвертация',
//                'code' => 'convertation'
//            ],
//            [
//                'name' => 'Вывод средств',
//                'code' => 'withdraw'
//            ],
//            [
//                'name' => 'Пополнение',
//                'code' => 'charge'
//            ],
//        ];
//        foreach ($accountTypes as $type){
//            $newType = new \App\Models\OperationType();
//            $newType->name = $type['name'];
//            $newType->code = $type['code'];
//            $newType->save();
//        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('operation_types');
    }
}

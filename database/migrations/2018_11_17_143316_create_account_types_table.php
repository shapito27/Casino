<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('account_types', function (Blueprint $table) {
//            $table->increments('id');
//            $table->string('code', 100)->unique();
//            $table->string('name', 100);
//            $table->timestamps();
//        });
//
//        $accountTypes = [
//            [
//                'name' => 'Денежный счет',
//                'code' => 'money'
//            ],
//            [
//                'name' => 'Бонусный счет',
//                'code' => 'bonus'
//            ],
//            [
//                'name' => 'Предметы',
//                'code' => 'subject'
//            ],
//        ];
//
//        foreach ($accountTypes as $type){
//            $newType = new \App\Models\AccountType();
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
//        Schema::dropIfExists('account_types');
    }
}

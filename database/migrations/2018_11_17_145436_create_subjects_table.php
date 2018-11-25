<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->text('description');
            $table->tinyInteger('available');
            $table->timestamps();
        });

        $newSubject1 = new \App\Services\Subject();
        $newSubject1->add([
            'name' => 'Ipad Gray',
            'description' => '128Gb',
        ]);

        $newSubject2 = new \App\Services\Subject();
        $newSubject2->add([
            'name' => 'TV',
            'description' => 'Samsung GH12SDF',
        ]);
        $newSubject3 = new \App\Services\Subject();
        $newSubject3->add([
            'name' => 'Trip to Thailand',
            'description' => '6 days in 4* Hotel',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subjects');
    }
}

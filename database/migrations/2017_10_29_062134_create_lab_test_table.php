<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLabTestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_test', function (Blueprint $table) {
            $table->increments('id');

            $table->string('test_name', 100);

            $table->integer('test_category_id')->nullable();
            $table->string('test_category_name')->nullable();

            $table->string('methodology')->nullable();
            $table->string('code')->nullable();
            $table->string('description')->nullable();
            $table->string('additional_information')->nullable();
            $table->integer('cost')->nullable();
            $table->text('currency')->nullable();

            $table->boolean('status')->default(true);

            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lab_test');
    }
}

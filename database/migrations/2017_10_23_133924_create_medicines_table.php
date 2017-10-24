<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicines', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name', 100);
            $table->string('code', 100)->nullable();
            $table->text('description')->nullable();

            $table->text('strength')->nullable();
            $table->text('indications_details')->nullable();
            $table->text('adult_dose')->nullable();
            $table->text('child_dose')->nullable();

            $table->text('renal_dose')->nullable();
            $table->text('administration')->nullable();
            $table->text('ingredients')->nullable();
            $table->text('contraindications')->nullable();

            $table->text('side_effects')->nullable();
            $table->text('precautions')->nullable();
            $table->text('pregnency_category')->nullable();
            $table->text('therapeutic_class')->nullable();

            $table->text('mode_of_actions')->nullable();
            $table->text('interactions')->nullable();

            $table->text('pack_size')->nullable();
            $table->integer('unit_price')->nullable();
            $table->text('currency')->nullable();

            $table->string('image')->nullable();

            $table->boolean('status')->default(true);

            $table->integer('generic_name_id')->nullable();
            $table->string('generic_name')->nullable();

            $table->integer('medicine_type_id')->nullable();
            $table->string('medicine_type_name')->nullable();

            $table->integer('pharma_id')->nullable();
            $table->string('pharma_name')->nullable();

            $table->string('class_is')->nullable();
            $table->integer('class_name')->nullable();

            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

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
        Schema::dropIfExists('medicines');
    }
}

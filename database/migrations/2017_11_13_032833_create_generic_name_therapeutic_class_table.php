<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGenericNameTherapeuticClassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generic_name_therapeutic_class', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('generic_id');
            $table->integer('therapeutic_id');

            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->unique(['generic_id', 'therapeutic_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('generic_name_therapeutic_class');
    }
}

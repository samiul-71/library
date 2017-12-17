<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePharmaceuticalCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pharmaceutical_companies', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->nullable();
            $table->string('name', 255);
            $table->string('registration_number', 50)->nullable();
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('address')->nullable();
            $table->boolean('status')->default(true);
            $table->string('company_type');
            $table->string('registration_status');

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
        Schema::dropIfExists('pharmaceutical_companies');
    }
}

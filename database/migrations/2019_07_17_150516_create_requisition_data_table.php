<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequisitionDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisition_data', function (Blueprint $table) {
            $table->bigIncrements('id');
                   
            $table->unsignedBigInteger('id_requisition');
            $table->unsignedBigInteger('id_requisition_cat'); 

            $table->integer('quantity');
            $table->string('part_number', 100);
            $table->text('description');
            $table->double('price', 10, 2);

            $table->dateTime('created_at');
        });

        Schema::table('requisition_data', function ($table){
            $table->foreign('id_requisition')->references('id')->on('requisitions');
            $table->foreign('id_requisition_cat')->references('id')->on('requisition_cats');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requisition_data');
    }
}

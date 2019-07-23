<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequisitionDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisition_descriptions', function (Blueprint $table) {
            $table->bigIncrements('id_requisition_description');
                   
            $table->unsignedBigInteger('id_requisition');
            $table->unsignedBigInteger('id_requisition_cat'); 

            $table->text('description');

            $table->dateTime('created_at');
        });


        Schema::table('requisition_descriptions', function ($table){
            $table->foreign('id_requisition')->references('id_requisition')->on('requisitions');
            $table->foreign('id_requisition_cat')->references('id_requisition_cat')->on('requisition_cats');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requisition_descriptions');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequisitionMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisition_media', function (Blueprint $table) {
            $table->bigIncrements('id_requisition_media');

            $table->unsignedBigInteger('id_requisition');
            $table->unsignedBigInteger('created_id_user');

            $table->text('description')->nullable();
            $table->string('url');

            $table->dateTime('created_at');
        });

        Schema::table('requisition_media', function ($table){
            $table->foreign('id_requisition')->references('id_requisition')->on('requisitions');
            $table->foreign('created_id_user')->references('id_user')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requisition_media');
    }
}

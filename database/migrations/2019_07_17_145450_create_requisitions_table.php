<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequisitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisitions', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->unsignedBigInteger('id_user');

            $table->unsignedBigInteger('id_site');
            
            $table->boolean('bool_ins_elec')->default(0);
            $table->boolean('bool_ins_phy_earth')->default(0);
            $table->boolean('bool_ins_grounding')->default(0);
            $table->boolean('bool_ins_lighting')->default(0);
            $table->boolean('bool_ins_supressor_a')->default(0);
            $table->boolean('bool_ins_supressor_b')->default(0);

            $table->dateTime('created_at');
        });

        Schema::table('requisitions', function ($table){
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_site')->references('id')->on('sites');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requisitions');
    }
}

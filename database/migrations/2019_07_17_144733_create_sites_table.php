<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->bigIncrements('id_site');
            $table->unsignedBigInteger('id_state');

            $table->string('code', 100);
            $table->string('instance', 100);
            $table->string('address', 200);
            
            $table->date('delivery_date')->nullable();
            $table->string('observations', 200)->nullable();

            $table->string('latitude', 25)->nullable();
            $table->string('longitude', 25)->nullable();
            $table->dateTime('created_at');
            
        });

        Schema::table('sites', function ($table){
            $table->foreign('id_state')->references('id_state')->on('states');
        });

        /*DB::statement("INSERT INTO
            sites
                (
                    id_site, name, latitude, longitude, created_at
                ) 
            VALUES 
                (1, 'Villahermosa', '15.12312', '-19.23123', NOW()),
                (2, 'Chiapas', '15.12312', '-19.23123', NOW()),
                (3, 'Veracruz', '15.12312', '-19.23123', NOW()),
                (4, 'Campeche', '15.12312', '-19.23123', NOW())
        ");*/

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sites');
    }
}

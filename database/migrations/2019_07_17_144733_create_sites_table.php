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

            $table->string('name', 100);
            $table->string('latitude', 25);
            $table->string('longitude', 25);
            $table->dateTime('created_at');
            
        });

        Schema::statement("INSERT INTO
            sites
        (
            id_site, name, latitude, longitude, created_at
        ) 
            VALUES (1, 'IB-México', '15.12312', '-19.23123', NOW())
            VALUES (2, 'r2a México', '15.12312', '-19.23123', NOW())
            VALUES (3, 'Innovare', '15.12312', '-19.23123', NOW())
            VALUES (4, 'UCA Soluciones', '15.12312', '-19.23123', NOW())

        ");

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

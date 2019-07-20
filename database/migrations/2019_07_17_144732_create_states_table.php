<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('states', function (Blueprint $table) {
            $table->bigIncrements('id_state');

            $table->string('name', 100);
            $table->integer('zone');

            $table->dateTime('created_at');
        });

        DB::statement("INSERT INTO
            states
                (id_state, name, zone, created_at)
            VALUES
                (1, 'Campeche', 2, NOW()),
                (2, 'Chiapas', 5, NOW()),
                (3, 'Tabasco', 2, NOW()),
                (4, 'Veracruz', 2, NOW()),
                (5, 'Oaxaca', 2, NOW()),
                (6, 'Quintana Roo', 2, NOW()),
                (7, 'Yucatán', 2, NOW())"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('states');
    }
}

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

            $table->dateTime('created_at');
        });

        DB::statement("INSERT INTO
            states
                (id_state, name, created_at)
            VALUES
                (1, 'Campeche', NOW()),
                (2, 'Chiapas', NOW()),
                (3, 'Tabasco', NOW()),
                (4, 'Veracruz', NOW()),
                (5, 'Oaxaca', NOW()),
                (6, 'Quintana Roo', NOW())"
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

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequisitionCatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisition_cats', function (Blueprint $table) {
            $table->bigIncrements('id_requisition_cat');

            $table->string('name', 100);

            $table->dateTime('created_at');
        });

        DB::statement("INSERT INTO
            requisition_cats
                (id_requisition_cat, name, created_at)
            VALUES
                (1, 'Instalación Eléctrica', NOW()),
                (2, 'Tierra Física', NOW()),
                (3, 'Sistema de Puesta Tierra', NOW()),
                (4, 'Punta de Pararrayos', NOW()),
                (5, 'Supresor de Picos Clase A', NOW()),
                (6, 'Supresor de Picos Clase B', NOW())");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requisition_cats');
    }
}

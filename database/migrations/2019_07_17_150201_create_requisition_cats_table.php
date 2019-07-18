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
        (id_entity, entity, created_at)
        VALUES (1, 'instalación eléctrica', NOW()),
        VALUES (2, 'puerta de acceso', NOW()),
        VALUES (3, 'sistema de puesta tierra', NOW()),
        VALUES (4, 'punta de para-rayo', NOW()),
        VALUES (5, 'supresor de picos clase a', NOW()),
        VALUES (6, 'supresor de picos clase b', NOW())");
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

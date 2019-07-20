<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id_user');

            $table->string('user', 100);
            $table->string('email', 100)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('name', 100);
            $table->rememberToken();

            $table->unsignedBigInteger('id_entity');

            $table->dateTime('created_at');
        });

        Schema::table('users', function ($table){
            $table->foreign('id_entity')->references('id_entity')->on('entities');
        });

        //NEW ROW
        DB::statement("INSERT INTO
                users
            ( id_user, user, email, password, name, id_entity, created_at) 
            VALUES (
                1, 'admin', 'jorge.cortes@ib-mexico.com', '" . bcrypt('pwd_19851920') . "', 'Jorge Cortés', 1, NOW()),
                (2, 'erick.montoya', 'erick.montoya@ib-mexico.com', '" . bcrypt('em_9k63gf') . "', 'Erick Montoya', 1, NOW()),
                (3, 'israel.prieto', 'israel.prieto@ib-mexico.com', '" . bcrypt('ip_b0tvxh') . "', 'Israel Prieto', 1, NOW()),
                (4, 'emilio.rabelo', 'emilio.rabelo@ib-mexico.com', '" . bcrypt('er_qdg0ts') . "', 'Emilio Rabelo', 1, NOW()),
                (5, 'harvey.cruz', 'harvey.cruz@ib-mexico.com', '" . bcrypt('hc_06vh9h') . "', 'Harvey Cruz', 1, NOW()),
                (6, 'ana.bernal', 'ana.bernal@portenntum.com', '" . bcrypt('a.b_rx7ef') . "', 'Ana Bernal', 1, NOW())
                
                ");  
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
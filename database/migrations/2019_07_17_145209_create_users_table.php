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
            (
                id_user, 
                user, 
                email,
                password,
                name,
                id_entity,
                created_at
            ) VALUES (
                1, 
                'admin', 
                'jorge.cortes@ib-mexico.com',
                '" . bcrypt('1234567890') . "',
                'Usuario de Prueba',
                1,
                NOW()
            )");  
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
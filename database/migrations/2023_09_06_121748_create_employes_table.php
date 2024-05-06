<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('number');
            $table->string('cnic')->nullable();
            $table->string('relation')->nullable();
            $table->string('eme_no_1')->nullable();
            $table->date('d_o_b');
            $table->unsignedBigInteger('gender');
            $table->unsignedBigInteger('marital');
            $table->string('blood')->nullable();
            $table->string('address');
            $table->string('address_2')->nullable();
            $table->string('img')->nullable();
            $table->string('empID')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('status')->default(1);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employes');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDebtInstallmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('debt_installments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('debtloan_id')->nullable();
            $table->integer('amount');
            $table->unsignedBigInteger('bank_acc_id')->nullable();
            $table->unsignedBigInteger('type_id')->nullable();
            $table->date('date')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('debt_installments');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->unsignedBigInteger('loan_Type_id');
            $table->foreign('loan_Type_id')->references('id')->on('loan_types');
            $table->string('purpose');
            $table->unsignedBigInteger('loanPlan_id');
            $table->foreign('loanPlan_id')->references('id')->on('loan_plans');
            $table->double('amount');
            $table->enum('status', ['request', 'confrimed', 'released','complteted','denied'])->default('request');
            $table->date('date_released')->format('d/m/Y');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loans');
    }
}

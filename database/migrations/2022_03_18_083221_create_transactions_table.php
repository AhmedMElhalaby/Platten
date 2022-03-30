<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('account_type');
            $table->foreignId('account_id');
            $table->tinyInteger('type');
            $table->double('amount');
            $table->tinyInteger('status')->default(\App\Models\Transaction::Statuses['Pending']);
            $table->tinyInteger('ref_type')->nullable();
            $table->foreignId('ref_id')->nullable();
            $table->string('payment_reference')->nullable();
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
        Schema::dropIfExists('transactions');
    }
}

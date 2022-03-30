<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWithdrawalRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdrawal_requests', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('account_type');
            $table->foreignId('account_id');
            $table->double('amount');
            $table->foreignId('bank_id')->constrained();
            $table->string('iban');
            $table->string('reject_reason')->nullable();
            $table->tinyInteger('status')->default(\App\Models\WithdrawalRequest::Statuses['Pending']);
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
        Schema::dropIfExists('withdrawal_requests');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained();
            $table->foreignId('vendor_id')->nullable()->constrained();
            $table->foreignId('discount_id')->nullable();
            $table->double('discount_amount')->default(0);
            $table->double('cost')->default(0);
            $table->double('amount')->default(0);
            $table->double('total_amount')->default(0);
            $table->double('total_profit')->default(0);
            $table->string('recipient_name');
            $table->string('mobile');
            $table->string('address');
            $table->string('lat');
            $table->string('lng');
            $table->string('map_address')->nullable();
            $table->tinyInteger('status')->default(\App\Models\Order::Statuses['Pending']);
            $table->string('note')->nullable();
            $table->string('reject_reason')->nullable();
            $table->string('cancel_reason')->nullable();
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
        Schema::dropIfExists('orders');
    }
}

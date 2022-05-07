<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained();
            $table->foreignId('category_id');
            $table->foreignId('sub_category_id');
            $table->foreignId('brand_id');
            $table->foreignId('product_type_id');
            $table->foreignId('product_type_model_id');
            $table->foreignId('product_type_model_color_id')->nullable();
            $table->foreignId('product_type_model_size_id')->nullable();
            $table->double('cost_price');
            $table->double('profit_rate');
            $table->double('sell_price');
            $table->double('discount')->default(0);
            $table->tinyInteger('type');
            $table->string('note')->nullable();
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('products');
    }
}

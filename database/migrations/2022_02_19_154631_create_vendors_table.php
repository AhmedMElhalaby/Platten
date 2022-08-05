<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->foreignId('country_id')->nullable()->constrained();
            $table->foreignId('city_id')->nullable()->constrained();
            $table->string('mobile')->nullable();
            $table->string('nickname')->nullable();
            $table->string('company_name')->nullable();
            $table->string('maroof_company_number')->nullable();
            $table->string('maroof_tax_number')->nullable();
            $table->string('address')->nullable();
            $table->string('address_alt')->nullable();
            $table->string('postcode')->nullable();
            $table->string('avatar')->nullable();
            $table->string('cover')->nullable();
            $table->string('device_token')->nullable();
            $table->string('device_type')->nullable();
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
        Schema::dropIfExists('vendors');
    }
}

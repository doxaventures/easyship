<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBillingDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->longText('billing_email')->nullable();
            $table->string('order_no');
            $table->string('billing_phone')->nullable();
            $table->longText('gateway');
            $table->string('billing_name');
            $table->string('billing_address1');
            $table->longText('billing_address2')->nullable();
            $table->string('city')->nullable();
            $table->string('zip')->nullable();
            $table->longText('billing_province')->nullable();
            $table->string('billing_country')->nullable();
            $table->string('billing_company')->nullable();
            $table->longText('billing_country_code')->nullable();
            $table->string('billing_province_code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCutomerInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

            Schema::table('orders', function (Blueprint $table) {
                $table->longText('customer_id');
                $table->longText('order_id');
                $table->longText('checkout_id');
                $table->string('order_status');
                $table->longText('customer_name');
                $table->bigInteger('customer_total_orders');
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

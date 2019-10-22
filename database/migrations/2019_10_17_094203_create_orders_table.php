<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('orders')) {
            Schema::create('orders', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->longText('order_created_at');
                $table->longText('easy_shipment_id');
                $table->string('store_name');
                $table->string('destination_name');
                $table->longText('destination_company_name')->nullable();
                $table->longText('destination_city');
                $table->string('destination_state');
                $table->longText('destination_postalcode');
                $table->string('destination_phone_no')->nullable();
                $table->string('destination_email')->nullable();
                $table->longText('platform_order_number');
                $table->string('platform_name');
                $table->string('shipment_state');
                $table->string('destination_country');
                $table->longText('courier_id');
                $table->longText('courier_name');
                $table->longText('delivery_time');
                $table->string('total_charges');
                $table->timestamps();
            });
        }
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

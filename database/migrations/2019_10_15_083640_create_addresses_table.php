<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

            Schema::create('addresses', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->longText('courier_id');
                $table->float('price');
                $table->longText('draft_order_id');
                $table->string('sender_country')->nullable();
                $table->string('sender_postal_code')->nullable();
                $table->string('sender_city')->nullable();
                $table->string('sender_state')->nullable();
                $table->longText('sender_address1')->nullable();
                $table->string('sender_address2')->nullable();
                $table->string('sender_name')->nullable();
                $table->string('sender_company')->nullable();
                $table->string('sender_contact')->nullable();
                $table->string('sender_email')->nullable();

                $table->string('reciever_country');
                $table->string('reciever_postal_code')->nullable();
                $table->string('reciever_city')->nullable();
                $table->string('reciever_state')->nullable();
                $table->longText('reciever_address1');
                $table->string('reciever_address2')->nullable();
                $table->string('reciever_name')->nullable();
                $table->string('reciever_company')->nullable();
                $table->string('reciever_contact')->nullable();
                $table->string('reciever_email')->nullable();
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
        Schema::dropIfExists('addresses');
    }
}

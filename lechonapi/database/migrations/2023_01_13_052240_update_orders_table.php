<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function(Blueprint $table){
            $table->dropColumn('customer_name');
            $table->dropColumn('customer_address');
            $table->dropColumn('product_id_and_quantity');
            $table->dropColumn('date_and_time');
            $table->dropColumn('contact_number');
            $table->string('cart_ids');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};

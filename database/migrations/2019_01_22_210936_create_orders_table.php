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
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('origin_lat', 10, 8)->comment('Origin Latitude');
            $table->decimal('origin_lng', 11, 8)->comment('Origin Longitude');
            $table->decimal('destination_lat', 10, 8)->comment('Destination Latitude');
            $table->decimal('destination_lng', 11, 8)->comment('Destination Longitude');
            $table->integer('distance')->comment('Distance in meter');
            $table->enum('status', ['UNASSIGNED', 'TAKEN'])->default('UNASSIGNED')->comment('Order status');
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

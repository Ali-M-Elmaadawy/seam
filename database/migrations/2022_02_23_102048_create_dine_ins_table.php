<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDineInsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dine_ins', function (Blueprint $table) {
            $table->id();
            $table->double('service_charge', 5, 2)->default(10);
            $table->foreignId( 'table_id' )->constrained();
            $table->foreignId( 'waiter_id' )->constrained();
            $table->foreignId( 'order_id' )->constrained();
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
        Schema::dropIfExists('dine_ins');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->nullable()->unsigned();
            $table->foreign('product_id')->references('id')->on('cat_products');
            $table->integer('pill_id')->nullable()->unsigned();
            $table->foreign('pill_id')->references('id')->on('cat_pills');
            $table->integer('package_id')->nullable()->unsigned();
            $table->foreign('package_id')->references('id')->on('cat_packages');
            $table->integer('service_id')->nullable()->unsigned();
            $table->foreign('service_id')->references('id')->on('cat_services');
            $table->integer('client_id')->nullable()->unsigned();
            $table->foreign('client_id')->references('id')->on('clients');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('count');
            $table->float('price', 8, 2);
            $table->float('amount', 8, 2);
            $table->string('description')->nullable();
            $table->bool('is_paid')->nullable();
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
        Schema::table('sales',function(Blueprint $table){
             $table->dropForeign(['product_id']);
             $table->dropForeign(['pill_id']);
             $table->dropForeign(['package_id']);
             $table->dropForeign(['service_id']);
             $table->dropForeign(['client_id']);
             $table->dropForeign(['user_id']);
        });

        Schema::dropIfExists('sales');
    }
}

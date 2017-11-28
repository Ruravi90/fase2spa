<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateSalesSimplify extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sales',function(Blueprint $table){
            $table->dropForeign(['product_id','pill_id','package_id','service_id']);
            $table->dropColumn(['product_id', 'pill_id', 'package_id','service_id']);
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
            $table->integer('product_id')->nullable()->unsigned();
            $table->foreign('product_id')->references('id')->on('cat_products');
            $table->integer('pill_id')->nullable()->unsigned();
            $table->foreign('pill_id')->references('id')->on('cat_pills');
            $table->integer('package_id')->nullable()->unsigned();
            $table->foreign('package_id')->references('id')->on('cat_packages');
            $table->integer('service_id')->nullable()->unsigned();
            $table->foreign('service_id')->references('id')->on('cat_services');
        });
    }
}

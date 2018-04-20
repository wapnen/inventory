<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCustomersAddTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('customers', function(Blueprint $table){
          $table->integer('no_of_transactions')->nullable();
          $table->double('total_transactions')->nullable();
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
        Schema::table('customers', function(Blueprint $table){
          $table->dropColumn('no_of_transactions')->nullable();
          $table->dropColumn('total_transactions')->nullable();
        });
    }
}

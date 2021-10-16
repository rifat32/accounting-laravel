<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parchases', function (Blueprint $table) {
            $table->id();
            $table->string("supplier");
            $table->string("reference_no");
            $table->date("purchase_date");
            $table->string("purchase_status");
            $table->integer("product_id");
            // $table->string("amount");
            $table->string("payment_method");
            $table->string("status_type");
            $table->integer("quantity");
            $table->integer("wing_id");

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
        Schema::dropIfExists('parchases');
    }
}

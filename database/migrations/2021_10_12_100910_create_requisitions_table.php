<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequisitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisitions', function (Blueprint $table) {
            $table->id();
            $table->string("rSupplier");
            $table->string("rReferenceNo");
            $table->date("rPurchaseDate");
            $table->string("rPurchaseStatus");
            $table->string("rProductId");
            $table->string("rAmount");
            $table->string("rPaymentMethod");

            $table->string("rStatusType");

            // {
            //     "rSupplier": "",
            //     "rReferenceNo": "",
            //     "rPurchaseDate": "",
            //     "rPurchaseStatus": "",
            //     "rProductId": 2,
            //     "rAmount": "",
            //     "rPaymentMethod": ""
            // }
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
        Schema::dropIfExists('requisitions');
    }
}

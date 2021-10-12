<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("pName");
            $table->string("pBrand");
            $table->string("pCategory");
            $table->string("pSku");
            $table->string("pQuantity");
            $table->string("pPrice");
            

//          {
//     "pName": "aa",
//     "pBrand": "aa",
//     "pUnit": "",
//     "pCategory": "aa",
//     "pSubCategory": "",
//     "pSku": "abcd",
//     "pQuantity": "0",
//     "pType": "",
//     "pTax": "",
//     "pTaxType": "",
//     "pPrice": "10"
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
        Schema::dropIfExists('products');
    }
}

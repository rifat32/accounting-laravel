<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->string("vendor");
            $table->date("billDate");
            $table->date("dueDate");
            $table->string("category");
            $table->integer("orderNumber");
            $table->boolean("discountApply");
            $table->timestamps();
            // {
            //     "vendor": "abcd",
            //     "billDate": "2021-10-14",
            //     "dueDate": "2021-10-15",
            //     "category": "eargeg",
            //     "orderNumber": "efewsf",
            //     "discountApply": false
            // }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bills');
    }
}

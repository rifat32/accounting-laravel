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
            $table->date("bill_date");
            $table->date("due_date");
            $table->string("category");
            $table->integer("order_number");
            $table->boolean("discount_apply");
            $table->integer("wing_id");
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

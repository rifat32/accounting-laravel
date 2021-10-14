<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRevenuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revenues', function (Blueprint $table) {
            $table->id();
            $table->date("date");
            $table->integer("amount");
            $table->string("account");
            $table->string("customer");
            $table->text("description");
            $table->string("category");
            $table->string("reference");
            // {
            //     "date": "2021-10-14",
            //     "amount": "10",
            //     "account": "sadefaer aeraerg ",
            //     "customer": "erfgre gaerge",
            //     "description": "fttghr",
            //     "category": "eargeg",
            //     "reference": "1015"
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
        Schema::dropIfExists('revenues');
    }
}

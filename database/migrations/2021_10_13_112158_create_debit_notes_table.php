<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDebitNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('debit_notes', function (Blueprint $table) {
            $table->id();
            $table->string("bill");
            $table->integer("amount");
            $table->date("date");
            $table->text("description");
            $table->timestamps();


            // {
            //     "bill": "dgefagarfe",
            //     "amount": "100",
            //     "date": "2021-10-14",
            //     "description": "dfghdfg dfgh gfh gf sgjgfr rtgh rfgh strgtrfgh srgjsrf j rstjrstj yyghj"
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
        Schema::dropIfExists('debit_notes');
    }
}

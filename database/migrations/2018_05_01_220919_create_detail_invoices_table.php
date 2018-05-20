<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('invoice_id')->unsigned();
            $table->foreign('invoice_id')->references('id')->on('invoices');
            $table->string('code_product');
            $table->decimal('unity',8,2);
            $table->integer('quantity');
            $table->string('description');
            $table->string('type_affectation_igv_code');
            $table->foreign('type_affectation_igv_code')->references('code')->on('type_affectation_igvs');
            $table->decimal('igv', 8, 2);
            $table->decimal('AmountValueSale', 8, 2);
            $table->decimal('amountValueUnit', 8, 2);
            $table->decimal('AmountPriceUnit', 8, 2);
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
        Schema::dropIfExists('detail_invoices');
    }
}

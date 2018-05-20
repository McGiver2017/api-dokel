<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('office_transmitter_id')->unsigned();
            $table->foreign('office_transmitter_id')->references('id')->on('offices');
            $table->integer('office_receiver_id')->unsigned();
            $table->foreign('office_receiver_id')->references('id')->on('offices');
            $table->string('type_document_code');
            $table->foreign('type_document_code')->references('code')->on('type_documents');
            $table->string('serie');
            $table->string('documento_correlativo');
            $table->string('documento_fechaEmision');
            $table->decimal('venta_igv', 8, 2);
            $table->decimal('venta_opExonerados', 8, 2);
            $table->decimal('venta_precioVenta', 8, 2);
            $table->decimal('venta_descuentoOpGravadas', 8, 2);
            $table->decimal('venta_opGravadas', 8, 2);
            $table->decimal('venta_opNoOnerosas', 8, 2);
            $table->decimal('venta_valorDescuento', 8, 2);
            $table->string('venta_tipoDeMoneda')->default('PEN');
            $table->string('venta_leyenda')->default('No se pudo procesar esta informacion');
            //$table->json('meta')->nullable();
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
        Schema::dropIfExists('invoices');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('enterprise_id')->unsigned();
            $table->string('direction');
            $table->string('cod_postal');
            $table->string('departament');
            $table->string('province');
            $table->string('district');            
            $table->string('serie_boleta')->default('F001');
            $table->string('serie_factura')->default('B001');
            $table->string('serie_nota_credito')->default('F101');
            $table->string('serie_nota_debito')->default('B101');
            $table->string('serie_guia_remision')->default('G001');
            $table->string('correlativo_boleta')->default('0');
            $table->string('correlativo_factura')->default('0');
            $table->string('correlativo_nota_credito')->default('0');
            $table->string('correlativo_nota_debito')->default('0');
            $table->string('correlativo_guia_remision')->default('0');
            $table->timestamps();
            $table->foreign('enterprise_id')->references('id')->on('enterprises')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offices');
    }
}

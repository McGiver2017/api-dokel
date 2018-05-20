<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->integer('invoice_id')->unsigned();
            $table->primary('invoice_id');
            $table->foreign('invoice_id')->references('id')->on('invoices');
            $table->integer('motive_note_id')->unsigned();
            $table->foreign('motive_note_id')->references('id')->on('motive_notes');
            $table->integer('serie_id')->unsigned();
            $table->foreign('serie_id')->references('id')->on('series');
            $table->dateTime('date_issue');
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
        Schema::dropIfExists('notes');
    }
}

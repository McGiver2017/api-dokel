<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypeNotesCreditDebitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_notes_credit_debits', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->string('type_document_code');
            $table->string('description');
            $table->foreign('type_document_code')->references('code')->on('type_documents')->onDelete('cascade');
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
        Schema::dropIfExists('type_notes_credit_debits');
    }
}

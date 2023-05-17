<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('note_ql', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('type', 30);
            $table->integer('id_ql')->nullable();
            $table->text('content_note_ql')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('note_ql');
    }
};

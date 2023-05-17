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
        Schema::create('note_nv', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('type', 30);
            $table->integer('id_nv')->notnull();
            $table->text('content_note_nv')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('note_nv');
    }
};

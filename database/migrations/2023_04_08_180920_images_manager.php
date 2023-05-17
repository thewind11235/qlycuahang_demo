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
        Schema::create('images_manager', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('id_task')->notnull();
            $table->string('type_task')->notnull();
            $table->integer('id_user')->notnull();
            $table->string('image_link')->notnull();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images_manager');
    }
};

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
        Schema::create('history_sync', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('sync_data')->notnull();
            $table->integer('id_user')->notnull();
            $table->string('status_sync')->notnull();
            $table->string('type_task')->notnull();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('history_sync');
    }
};

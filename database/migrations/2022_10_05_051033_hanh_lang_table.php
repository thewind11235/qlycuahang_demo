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
        Schema::create('hanh_lang', function (Blueprint $table) {
            $table->id();
            $table->integer('id_nv')->notnull();
            $table->integer('id_nvw')->nullable();
            $table->timestamp('create_time');
            $table->timestamp('update_time_nv')->nullable();
            $table->timestamp('update_time_ql')->nullable();
            $table->integer('id_status_nv')->default(1);
            $table->integer('id_status_ql')->default(1);
            $table->integer('id_note_nv');
            $table->integer('id_note_ql');
            $table->string('toa_do_nv', 100)->notnull();
            $table->string('toa_do_nvw', 100)->nullable();
            // customize details rows
            $table->string('xuat_tuyen', 20);
            $table->string('tu_tru_den_tru', 30)->nullable();
            //
            $table->integer('so_cay')->nullable();
            $table->string('khoang_cach', 30);
            $table->string('pa_phat_quang', 30);
            //
            $table->string('de_xuat', 100)->nullable();
            $table->string('muc_do', 100);
            $table->text('device_info')->notnull();
            $table->text('images')->nullable();
            $table->text('images_nvw')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hanh_lang');
    }
};

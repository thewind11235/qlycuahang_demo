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
        Schema::create(
            'bills', function (Blueprint $table) {
                $table->id();
                $table->integer('staff_id');
                $table->string('name_device');
                $table->string('status_device');
                $table->text('description');
                $table->text('accessory_ids')->nullable();
                $table->decimal('price', 10, 2);
                $table->string('estimate_time');
                $table->string('status_bill');
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bills');
    }
};

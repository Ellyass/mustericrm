<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepairCallExplanationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repair_call_explanations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('repair_expalnation');
            $table->unsignedBigInteger('repair_customer_id');
            $table->foreign('repair_customer_id')->references('id')->on('repair_customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('repair_call_explanations');
    }
}

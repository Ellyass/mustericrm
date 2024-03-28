<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('added_by_user_id'); // Kullanıcı ID'si
            $table->timestamps();
            $table->string('customer_name','100');
            $table->string('customer_city','20');
            $table->string('customer_company_name')->nullable();
            $table->string('customer_official','100')->nullable();;
            $table->string('customer_mail')->nullable();;
            $table->string('customer_address')->nullable();;
            $table->string('customer_phone','11');
            $table->string('customer_phone_home','11')->nullable();;
            $table->string('customer_url')->nullable();;
            $table->string('customer_status');
            $table->text('customer_cancel');
            $table->text('customer_meet');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}

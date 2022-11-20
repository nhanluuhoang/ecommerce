<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('company_logo');
            $table->string('company_name');
            $table->text('company_info');
            $table->string('company_address');
            $table->string('company_tax_code');
            $table->json('company_contact');
            $table->text('return_policy');
            $table->text('terms_of_sale');
            $table->text('delivery_policy');
            $table->text('payment_methods');
            $table->text('information_privacy_policy');
            $table->json('shop_online');
            $table->json('social_network');
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
        Schema::dropIfExists('setting');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\ShipmentStatusEnum;

class CreateShipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders');
            $table->foreignId('invoice_id')->constrained('invoices');
            $table->string('name');
            $table->string('phone');
            $table->string('address');
            $table->string('order_code')->index();
            $table->dateTime('shipment_date')->nullable();
            $table->enum('shipment_status', ShipmentStatusEnum::getValues())->default(ShipmentStatusEnum::WAITING)->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipments');
    }
}

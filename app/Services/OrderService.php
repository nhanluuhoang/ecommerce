<?php

namespace App\Services;

use App\Enums\InvoiceStatusCodeEnum;
use App\Enums\ShipmentStatusEnum;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Shipment;
use Carbon\Carbon;

class OrderService
{
    /**
     * Create Order
     *
     * @param $data
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function createOrder($data)
    {
        return Order::query()->create($data);
    }

    /**
     * Create OrderItems
     *
     * @param $orders
     * @param $data
     * @return mixed
     */
    public function createOrderItems($orders, $data)
    {
        return $orders->orderItems()->createMany($data);
    }

    /**
     * Create Invoice
     *
     * @param $orderId
     * @param $data
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function createInvoice($orderId, $data)
    {
        return Invoice::query()->create([
            'order_id'            => $orderId,
            'invoice_status_code' => InvoiceStatusCodeEnum::COD,
            'invoice_date'        => Carbon::now(),
            'total_amount'        => $data['total_amount'],
            'total_discount'      => $data['total_discount'],
            'order_code'          => $data['order_code']
        ]);
    }

    /**
     * Create Shipment
     *
     * @param $orderId
     * @param $invoiceId
     * @param $data
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function createShipment($orderId, $invoiceId, $data)
    {
        $address = '';
        if (count($data) <= 0) {
            $data = auth()->user();

            foreach ($data['address'] as $key => $value) {
                if ($value['default']) {
                    $address = $value['address'];
                }
            }
        } else {
            $address = $data['address'];
        }

        return Shipment::query()->create([
            'order_id'        => $orderId,
            'invoice_id'      => $invoiceId,
            'full_name'       => $data['full_name'],
            'phone'           => $data['phone'],
            'address'         => $address,
            'order_code'      => $data['order_code'],
            'shipment_date'   => Carbon::now(),
            'shipment_status' => ShipmentStatusEnum::WAITING,
        ]);
    }

    /**
     * Create ShipmentItems
     *
     * @param $shipment
     * @param $orderItems
     * @return void
     */
    public function createShipmentItems($shipment, $orderItems)
    {
        foreach ($orderItems as $item) {
            $shipment->shipmentItems()->create([
                'order_item_id' => $item->id,
                'quantity'      => $item->quantity,
            ]);
        }
    }

    /**
     * Update Order
     *
     * @param $order
     * @param $data
     * @return mixed
     */
    public function updateOrder($order, $data)
    {
        return $order->update($data);
    }

    /**
     * Update OrderItem
     *
     * @param $order
     * @param $orderItems
     * @return array
     */
    public function updateOrderItems($order, $orderItems)
    {
        $tmpOrderItems = [];
        foreach ($orderItems as $item) {
            if (isset($item['id'])) {
                $orderItem = OrderItem::query()->findOrFail($item['id']);
                $orderItem->update($item);
                $tmpOrderItems[] = $item['id'];
            } else {
                $orderItem = OrderItem::query()->create($item);
                $tmpOrderItems[] = $orderItem->id;
            }
        }

        $orderItemsOld = OrderItem::query()
            ->select('id')
            ->where('product_id', $order->id)
            ->get()
            ->pluck('id');
        $arrDiff = array_diff($tmpOrderItems, $orderItemsOld->toArray());
        OrderItem::query()->whereIn('id', $arrDiff)->delete();

        return $tmpOrderItems;
    }
}

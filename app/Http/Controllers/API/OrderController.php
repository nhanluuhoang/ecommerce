<?php

namespace App\Http\Controllers\API;

use App\Enums\OrderStatusCodeEnum;
use App\Http\Requests\Order\CreateOrderRequest;
use App\Http\Requests\Order\UpdateOrderRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Queries\Query;
use App\Services\OrderService;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Exception;

class OrderController extends ApiBaseController
{
    private $service;

    public function __construct()
    {
        $this->service = new OrderService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $orders = new Query(Order::class);
        $orders = $orders->filterBy([
            'order_code'        => 'partial',
            'order_status_code' => '='
        ])
            ->sortFieldsBy(['total_amount', 'total_discount'])
            ->allowPaginate();

        return $this->httpOK($orders);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateOrderRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateOrderRequest $request)
    {
        $data = $request->validated();
        $orderItemsData = Arr::get($data, 'order_items', []);

        DB::beginTransaction();
        try {
            $data['order_code'] = strtoupper(uniqid());

            $order = $this->service->createOrder($data);
            $orderItems = $this->service->createOrderItems($order, $orderItemsData);

            if ($data['order_status_code'] === OrderStatusCodeEnum::SUBMITTED) {
                $shipmentData = Arr::get($data, 'shipments', []);
                $shipmentData['order_code'] = $data['order_code'];

                $invoice = $this->service->createInvoice($order->id, $data);
                $shipment = $this->service->createShipment($order->id, $invoice->id, $shipmentData);
                $this->service->createShipmentItems($shipment, $orderItems);
            }

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            return $this->httpBadRequest($exception->getMessage());
        }

        return $this->httpNoContent();
    }

    /**
     * Display the specified resource.
     *
     * @param Order $order
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Order $order)
    {
        $order = Order::query()->where('id', $order->id)->with([
            'orderItems: id, product_id, order_id, product_title, quantity, price, discount_amount',
            'shipment: id, order_id, invoice_id, full_name, phone, address, order_code, shipment_date',
            'invoice: id, order_id, invoice_status_code, invoice_date, total_amount, total_discount, order_code'
        ])->first();
        return $this->httpOK($order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateOrderRequest $request
     * @param Order $order
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        $data = $request->validated();
        $orderItemsData = Arr::get($data, 'order_items', []);

        DB::beginTransaction();
        try {
            $order = $this->service->updateOrder($order, $data);
            $orderItemsIds = $this->service->updateOrderItems($order, $orderItemsData);

            if ($data['order_status_code'] === OrderStatusCodeEnum::SUBMITTED) {
                $shipmentData = Arr::get($data, 'shipments', []);
                $shipmentData['order_code'] = $data['order_code'];

                $invoice = $this->service->createInvoice($order->id, $data);
                $shipment = $this->service->createShipment($order->id, $invoice->id, $shipmentData);

                $orderItems = OrderItem::query()->whereIn('id', $orderItemsIds)->get();

                $this->service->createShipmentItems($shipment, $orderItems);
            }

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            return $this->httpBadRequest($exception->getMessage());
        }

        return $this->httpNoContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Order $order
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return $this->httpNoContent();
    }
}

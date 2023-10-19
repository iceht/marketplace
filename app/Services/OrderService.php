<?php

namespace App\Services;

use App\Enums\OrderStatus;
use App\Enums\ShippingMethod;
use App\Http\DTO\OrderId;
use App\Http\DTO\OrderIdBuilder;
use App\Http\DTO\OrderSummaryBuilder;
use App\Models\Order;
use DateTime;
use Exception;
use Illuminate\Support\Facades\DB;

readonly class OrderService
{

    public function search(array $validated): array
    {
        $id = $validated['id'] ?? null;
        $status = $validated['status'] ?? null;
        $from = $validated['from'] ?? null;
        $to = $validated['to'] ?? null;

        $query = DB::table('orders');
        if (!empty($id)) {
            $query->where('id', $id);
        }
        if (!empty($status)) {
            $query->where('status', OrderStatus::from($status));
        }
        if (!empty($from)) {
            $query->where('created_at', '>=', new DateTime($from));
        }
        if (!empty($to)) {
            $query->where('created_at', '<=', new DateTime($to));
        }

        $summa = DB::table('order_products')
            ->selectRaw('SUM(quantity*unit_price)')
            ->whereRaw('order_id = id')
            ->take(1);

        $query->select('*');
        $query->selectSub($summa, 'summa');

        $data = $query->get();

        $retVal = [];
        foreach ($data as $row) {
            $builder = new OrderSummaryBuilder();
            $retVal[] = $builder->id($row->id)
                ->customer($row->name)
                ->status(OrderStatus::from($row->status))
                ->createdAt(new DateTime($row->created_at))
                ->sum($row->summa)
                ->build();
        }
        return $retVal;
    }

    public function updateStatus(array $validated): void
    {
        try {
            DB::beginTransaction();
            $order = Order::find($validated['id']);
            $order->status = OrderStatus::from($validated['status']);
            $order->save();
            Db::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function create(array $validated): OrderId
    {
        try {
            DB::beginTransaction();
            $order = new Order();
            $order->name = $validated['customerName'];
            $order->email = $validated['customerEmail'];
            $order->shipping_method = ShippingMethod::from($validated['shippingMethod']);
            $order->status = OrderStatus::New;

            $order->save();

            foreach ($validated['products'] as $p) {
                $order->products()->create([
                    'name' => $p['name'],
                    'quantity' => $p['quantity'],
                    'unit_price' => $p['unitPrice'],
                ]);
            }
            $order->shippingAddress()->create($validated["shippingAddress"]);
            $order->billingAddress()->create($validated["billingAddress"]);
            Db::commit();

            $builder = new OrderIdBuilder();

            return $builder->id($order->id)->build();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}

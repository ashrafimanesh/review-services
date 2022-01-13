<?php


namespace Services\Shop\Classes;


use Services\Shop\Constants\OrderStatuses;
use Services\Shop\Models\Order;
use Services\Shop\Models\OrderItem;

class OrderRepository
{
    public function hasBought($productKey, $userKey): bool
    {
        return Order::query()
            ->join("order_items", "orders.id", '=', "order_items.order_id")
            ->whereUserId($userKey)
            ->whereProductId($productKey)
            ->whereStatus(OrderStatuses::APPROVED)
            ->exists();
    }
}

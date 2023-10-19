<?php

namespace App\Http\DTO;

use App\Enums\OrderStatus;
use DateTime;
use JsonSerializable;

class OrderSummary implements JsonSerializable
{

    private int $id;
    private OrderStatus $status;
    private string $customer;
    private DateTime $createdAt;
    private float $sum;

    public function __construct(OrderSummaryBuilder $builder)
    {
        $this->id = $builder->getId();
        $this->status = $builder->getStatus();
        $this->customer = $builder->getCustomer();
        $this->createdAt = $builder->getCreatedAt();
        $this->sum = $builder->getSum();
    }


    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'customer' => $this->customer,
            'createdAt' => $this->createdAt->format("Y-m-d\TH:i:s.v\Z"),
            'sum' => $this->sum,
        ];
    }
}

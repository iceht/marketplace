<?php

namespace App\Http\DTO;

use App\Enums\OrderStatus;
use DateTime;

class OrderSummaryBuilder
{
    private int $id;
    private OrderStatus $status;
    private string $customer;
    private DateTime $createdAt;
    private float $sum;

    public function getId(): int
    {
        return $this->id;
    }

    public function id(int $id): OrderSummaryBuilder
    {
        $this->id = $id;
        return $this;
    }

    public function getStatus(): OrderStatus
    {
        return $this->status;
    }

    public function status(OrderStatus $status): OrderSummaryBuilder
    {
        $this->status = $status;
        return $this;
    }

    public function getCustomer(): string
    {
        return $this->customer;
    }

    public function customer(string $customer): OrderSummaryBuilder
    {
        $this->customer = $customer;
        return $this;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function createdAt(DateTime $createdAt): OrderSummaryBuilder
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getSum(): float
    {
        return $this->sum;
    }

    public function sum(float $sum): OrderSummaryBuilder
    {
        $this->sum = $sum;
        return $this;
    }

    public function build(): OrderSummary
    {
        return new OrderSummary($this);
    }


}

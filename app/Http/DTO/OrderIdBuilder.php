<?php

namespace App\Http\DTO;

class OrderIdBuilder
{
    private int $id;

    public function getId(): int
    {
        return $this->id;
    }

    public function id(int $id): OrderIdBuilder
    {
        $this->id = $id;
        return $this;
    }

    public function build()
    {
        return new OrderId($this);
    }


}

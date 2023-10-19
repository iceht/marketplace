<?php

namespace App\Http\DTO;

use JsonSerializable;

class OrderId implements JsonSerializable
{
    private string $id;

    public function __construct(OrderIdBuilder $builder)
    {
        $this->id = $builder->getId();
    }


    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id
        ];
    }
}

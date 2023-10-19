<?php

namespace App\Enums;

enum ShippingMethod : string
{
    case Delivery = "delivery";
    case InPerson = "in_person";
}

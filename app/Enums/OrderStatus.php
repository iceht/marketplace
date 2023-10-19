<?php

namespace App\Enums;

enum OrderStatus : string
{
    case New = "new";
    case Completed = "completed";
}

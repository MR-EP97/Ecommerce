<?php

namespace App\Enums;

enum OrderStatus: string
{
    case Paid = 'paid';
    case Preparing = 'preparing';
    case Shipping = 'shipping';
    case Delivered = 'delivered';
}

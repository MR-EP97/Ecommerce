<?php

namespace App\States\OrderStates;

use App\States\OrderState;

class Delivered extends OrderState
{
    public function label(): string
    {
        return 'delivered';
    }
}

<?php

namespace App\States\OrderStates;

use App\States\OrderState;

class Shipping extends OrderState
{

    public function label(): string
    {
        return 'Shipping';
    }
}

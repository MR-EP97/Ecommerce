<?php

namespace App\States\OrderStates;

use App\States\OrderState;

class Preparing extends OrderState
{

    public function label(): string
    {
        return 'Preparing';
    }
}

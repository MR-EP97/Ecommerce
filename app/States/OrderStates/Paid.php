<?php

namespace App\States\OrderStates;

use App\States\OrderState;
use Spatie\ModelStates\Exceptions\InvalidConfig;
use Spatie\ModelStates\StateConfig;

class Paid extends OrderState
{
    public function label(): string
    {
        return 'paid';
    }
}

<?php

namespace App\States;

use App\States\OrderStates\Delivered;
use App\States\OrderStates\Paid;
use App\States\OrderStates\Preparing;
use App\States\OrderStates\Shipping;
use Spatie\ModelStates\Exceptions\InvalidConfig;
use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;

abstract class OrderState extends State
{
    abstract public function label(): string;

    /**
     * @throws InvalidConfig
     */
    public static function config(): StateConfig
    {
        return parent::config()
            ->default(Paid::class)
            ->allowTransition(Paid::class, Preparing::class)
            ->allowTransition(Preparing::class, Shipping::class)
            ->allowTransition(Shipping::class, Delivered::class);
    }

    public function __invoke(): array
    {
        return [
            'paid',
            'preparing',
            'shipping',
            'delivered'
        ];
    }
}

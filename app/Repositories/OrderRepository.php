<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository extends Repository
{
    /**
     * @return mixed|string
     */
    public function model()
    {
        return Order::class;
    }
}
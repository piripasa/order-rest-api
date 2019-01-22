<?php

namespace App\Repositories\Criteria\Order;

use App\Repositories\Criteria\Criteria;
use App\Repositories\RepositoryInterface as Repository;

/**
 * Class OrderList
 * @package App\Repositories\Criteria
 */
class OrderList extends Criteria
{
    /**
     * OrderList constructor.
     * @param $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * @param $model
     * @param Repository $repository
     * @return mixed
     */
    public function apply($model, Repository $repository)
    {
        $query = $model->orderBy('order','asc');
        return $query;
    }
}
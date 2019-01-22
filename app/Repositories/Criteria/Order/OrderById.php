<?php

namespace App\Repositories\Criteria\Order;

use App\Repositories\Criteria\Criteria;
use App\Repositories\RepositoryInterface as Repository;

class OrderById extends Criteria
{
    protected $id;

    /**
     * OrderById constructor.
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
        $query = $model->where('id', $this->id);
        return $query;
    }
}
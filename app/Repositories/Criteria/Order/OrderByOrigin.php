<?php

namespace App\Repositories\Criteria\Order;

use App\Repositories\Criteria\Criteria;
use App\Repositories\RepositoryInterface as Repository;

class OrderByOrigin extends Criteria
{
    protected $lat;
    protected $lng;

    /**
     * OrderByOrigin constructor.
     */
    public function __construct($lat, $lng)
    {
        $this->lat = $lat;
        $this->lng = $lng;
    }


    /**
     * @param $model
     * @param Repository $repository
     * @return mixed
     */
    public function apply($model, Repository $repository)
    {
        return $model->where('origin_lat', $this->lat)->where('origin_lng', $this->lng);
    }
}
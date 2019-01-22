<?php

namespace App\Repositories\Criteria\Order;

use App\Repositories\Criteria\Criteria;
use App\Repositories\RepositoryInterface as Repository;

class OrderByDestination extends Criteria
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
        return $model->where('destination_lat', $this->lat)->where('destination_lng', $this->lng);
    }
}
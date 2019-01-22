<?php

namespace App\Services;

use App\Repositories\Criteria\Order\OrderByDestination;
use App\Repositories\Criteria\Order\OrderByOrigin;
use App\Repositories\OrderRepository;


/**
 * Class OrderService
 * @package App\Services
 */
class OrderService
{

    /**
     * @var OrderRepository
     */
    protected $orderRepository;

    /**
     * UserService constructor.
     * @param OrderRepository $orderRepository
     */
    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }


    /**
     * @param $data
     * @return mixed
     * @throws \Exception
     */
    public function storeOrder($data)
    {
        $dataMapper = [];

        try {
            $dataMapper['origin_lat'] = $data['origin'][0];
            $dataMapper['origin_lng'] = $data['origin'][1];
            $dataMapper['destination_lat'] = $data['destination'][0];
            $dataMapper['destination_lng'] = $data['destination'][1];
            if ($this->checkDuplicate($dataMapper)) {
                throw new \Exception("Order already placed");
            }
            $dataMapper['distance'] = GoogleMapService::getDrivingDistance($dataMapper['origin_lat'], $dataMapper['origin_lng'], $dataMapper['destination_lat'], $dataMapper['destination_lng']);;
            $dataMapper['status'] = ORDER_UNASSIGNED;
            app('db')->beginTransaction();
            $order = $this->orderRepository->create($dataMapper);
            app('db')->commit();
            return $order;
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }

    }


    /**
     * @param $data
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    public function updateOrder($data, $id)
    {
        try {
            return $this->orderRepository->update($data, $id);
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }


    /**
     * @param array $params
     * @return mixed
     * @throws \Exception
     */
    public function fetchOrders($params = [])
    {
        try {
            $limit = isset($params['limit']) ? $params['limit'] : 15;
            return $this->orderRepository->paginate($limit);
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }


    /**
     * @param $id
     * @return mixed
     */
    public function fetchOrderById($id)
    {
        return $this->orderRepository->find($id);
    }


    public function checkDuplicate($data)
    {
        $result =  $this->orderRepository->getByCriteria(new OrderByOrigin($data['origin_lat'], $data['origin_lng']))
            ->getByCriteria(new OrderByDestination($data['destination_lat'], $data['destination_lng']))
            ->all();

        return $result->count() > 0 ? true : false;
    }

}
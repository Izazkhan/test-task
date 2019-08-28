<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\OrderRepository;
use App\Entities\Order;
use App\Validators\OrderValidator;

/**
 * Class OrderRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class OrderRepositoryEloquent extends BaseRepository implements OrderRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Order::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
    public function getAllOrders()
    {
        return $this->model->all();
    }

    public function ordersOfClient($id)
    {
        return $this->model->where($this->model::ATTR_CUSTOMER_NUMBER,$id)->get();
    }


    public function getOrdersAjax($data)
    {
        // default arguments if not provided these will be considered
        $default = ['limit' => 10,'start' => 0,'order' => 0,'dir' => 'asc','search' => ''];
        $data = array_merge($default,$data);
        extract($data);

        // fields of orders model / entity
        $searchable = [
            $this->model::ATTR_KEY,
            $this->model::ATTR_CUSTOMER_NUMBER,
            $this->model::ATTR_ORDER_DATE,
            $this->model::ATTR_SHIPPED_DATE,
            $this->model::ATTR_REQUIRED_DATE,
            $this->model::ATTR_STATUS,
            $this->model::ATTR_COMMENT,
        ];

        // get data for orders
        $orders = $this->model->where(function($q) use ($limit,$start,$search,$order,$dir,$searchable){
            if ($search != '') {
                foreach ($searchable as $field) {
                  $q->orWhere($field,'like',"%{$search}%");
                }
            }
        })
        ->orderBy($searchable[$order],$dir)
        ->get();
        
        $data = ['total' => count($orders),'filtered' =>$orders->slice($start,$limit)];

        return $data;
    }

    public function getOrderDetails($id)
    {
        // dd ($this->model->where(
        //     $this->model()::ATTR_KEY,$id
        // )->get());
    }

}

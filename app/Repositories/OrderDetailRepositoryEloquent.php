<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\OrderDetailRepository;
use App\Entities\OrderDetail;
use App\Validators\OrderDetailValidator;

/**
 * Class OrderDetailRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class OrderDetailRepositoryEloquent extends BaseRepository implements OrderDetailRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return OrderDetail::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getOrderDetails($id)
    {
        // return order detaiuls
        return ($this->model->with(['product','order.customer'])->where(
            $this->model()::ATTR_ORDER_NUMBER,$id
        )->get());
    }    
}

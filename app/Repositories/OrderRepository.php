<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface OrderRepository.
 *
 * @package namespace App\Repositories;
 */
interface OrderRepository extends RepositoryInterface
{
    public function ordersOfClient($id);    
    public function getAllOrders();    
    public function getOrdersAjax(array $data);    
}

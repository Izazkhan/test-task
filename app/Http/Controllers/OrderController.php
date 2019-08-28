<?php

namespace App\Http\Controllers;

use App\Repositories\OrderDetailRepositoryEloquent;
use App\Repositories\OrderRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class OrdersController.
 *
 * @package namespace App\Http\Controllers;
 */
class OrderController extends Controller
{
    
    protected $repository;
    protected $orderDetailRepository;

    public function __construct(OrderRepositoryEloquent $repository,OrderDetailRepositoryEloquent $orderDetailRepository){
        $this->repository = $repository;
        $this->orderDetailRepository = $orderDetailRepository;
    }

    public function index()
    {
        return view('orders',['orders'=>$this->repository->with('customer')->all()]);
    }

    public function orderDetails(Request $request)
    {
        // if order id is missing from request return erorr message and redirect
        if (!isset($request->id)) {
            return redirect('/orders')->with(['error' => 'Order number is missing.']);
        }
        // get order details by orderNumber
        $orderDetails = $this->orderDetailRepository->getOrderDetails($request->id);
        if (!count($orderDetails)) {
            return redirect('/orders')->with(['error' => 'No Order Details.']);
        }

        // dd($orderDetails->first());
        return view('orders-details',['orderDetails'=>$orderDetails,'orderNumber' => $request->id]);
    }
}

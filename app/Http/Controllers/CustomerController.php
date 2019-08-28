<?php

namespace App\Http\Controllers;

use App\Entities\Customer;
use App\Repositories\CustomerRepositoryEloquent;
use App\Repositories\OrderRepositoryEloquent;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
	protected $repository;
    protected $orderRepository;
    public function __construct(CustomerRepositoryEloquent $repository,OrderRepositoryEloquent $orderRepository)
    {
    	$this->repository = $repository;
        $this->orderRepository = $orderRepository;
    }

    public function getAllCustomers(Request $request)
    {
    	$customers = $this->repository->limitCustomers(10);
    	return view('customers',['customers' => $customers['limited'], 'totalCount' => $customers['totalCount']]);
    }

    public function getNextCustomers(Request $request)
    {
        // This will return data for DataTable 

        // possible perameters 
    	$limit = $request->input('length');
		$start = $request->input('start');
		$order = $request->input('order.0.column');
		$dir = $request->input('order.0.dir');
		$search_word = $request->input('search.value');

        // get data from database using repository

		$customers = $this->repository->customersAjax(['limit' => $limit,'start' => $start,'order' => $order,'dir' => $dir,'search' => $search_word]);

		$filtered_data = $customers['filtered'];
        $totalCount = $customers['total'];

        $data = $neat_data = [];
        $fields = [
            $this->repository->model()::ATTR_KEY,
            $this->repository->model()::ATTR_CUSTOMER_NAME,
            $this->repository->model()::ATTR_CITY,
            $this->repository->model()::ATTR_POSTAL_CODE,
            $this->repository->model()::ATTR_COUNTRY,
            $this->repository->model()::ATTR_STATE,
            $this->repository->model()::ATTR_PHONE
        ];
        foreach ($filtered_data as $customer) {
        	foreach ($fields as $field) {
	        	$data[$field] = $customer[$field];
        	}
            $route = route('customer-orders',['id' => $customer[$this->repository->model()::ATTR_KEY]]);
            $data['contactName'] = $customer['contactName'];
            $data['address'] = $customer['address'];
            $data['link'] = "<a href='".$route."'>Click Here</a>";
        	$neat_data[] = $data;
        }

		$json_data = [
		  "draw" => intval($request->draw),
		  "recordsTotal" => intval($totalCount),
		  "recordsFiltered" => intval($totalCount),
		  "data" => $neat_data
		];

	    echo json_encode($json_data);
    }

    public function customerOrders(Request $request)
    {
        // get customer
        $customer = $this->repository->model()::where(
            $this->repository->model()::ATTR_KEY,$request->id
        )->first();
        // if customer is not avaialble
        if (!$customer) {
            return redirect('/customers')->with(['error' => 'Customer does not exists']);
        }
        // get order of clients, from Order Model using CustomerNumber
        $orders = $this->orderRepository->ordersOfClient($request->id);
        if (!count($orders))
            return redirect('/customers')->with(['error' => 'No orders found.']);
        return view('customer-orders',['orders' => $orders,'customer' => $customer]);
    }

    public function addCustomer(Request $request)
    {
        $this->validate($request,['customer_name'=>'required','first_name'=>'required','last_name'=>'required','phone'=>'required','address1'=>'required','country'=>'required','city' => 'required','post_code' => 'max:5']);
        
        // Create new customer object
        $customer = new Customer();
        // get maximum customer number to avoid repeatition thats why we did not passed it manually
        $customerNumber = Customer::max($customer::ATTR_KEY)+1;
        $customer->{$customer::ATTR_KEY} = $customerNumber;
        $customer->{$customer::ATTR_CUSTOMER_NAME} = $request->customer_name;
        $customer->{$customer::ATTR_CONTACT_FIRST_NAME} = $request->first_name;
        $customer->{$customer::ATTR_CONTACT_LAST_NAME} = $request->last_name;
        $customer->{$customer::ATTR_ADDRESS_FIRST} = $request->address1;
        $customer->{$customer::ATTR_ADDRESS_LAST} = $request->address2;
        $customer->{$customer::ATTR_CITY} = $request->city;
        $customer->{$customer::ATTR_STATE} = $request->state;
        $customer->{$customer::ATTR_POSTAL_CODE} = $request->post_code;
        $customer->{$customer::ATTR_COUNTRY} = $request->country;
        $customer->{$customer::ATTR_PHONE} = $request->phone;
        $customer->{$customer::ATTR_CREDIT_LIMIT} = $request->credit_limit;
        $customer->timestamps = false;
        $customer->save();

        return redirect()->back()->with(['success' => 'Customer successfully added.']);
    }
}

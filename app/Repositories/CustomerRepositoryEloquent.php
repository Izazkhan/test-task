<?php

namespace App\Repositories;

use App\Entities\Customer;
use App\Repositories\CustomerRepository;
use App\Validators\CustomerValidator;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class CustomerRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CustomerRepositoryEloquent extends BaseRepository implements CustomerRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Customer::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return CustomerValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }


    public function limitCustomers($limit = 10)
    {
        $customers = $this->model->orderBy($this->model::ATTR_CUSTOMER_NAME)->limit($limit)->get();
        $totalCustomesCount = $this->model->count('*');
        return ['totalCount'=>$totalCustomesCount,'limited' => $customers];
    }

    public function customersAjax($data = [])
    {
        $default = ['limit' => 10,'start' => 0,'order' => 0,'dir' => 'asc','search' => ''];
        $data = array_merge($default,$data);
        extract($data);

        $searchable = [
            $this->model()::ATTR_KEY,
            $this->model::ATTR_CUSTOMER_NAME,
            $this->model::ATTR_CONTACT_LAST_NAME,
            $this->model::ATTR_CONTACT_FIRST_NAME,
            $this->model::ATTR_ADDRESS_FIRST,
            $this->model::ATTR_ADDRESS_LAST,
            $this->model::ATTR_CITY,
            $this->model::ATTR_POSTAL_CODE,
            $this->model::ATTR_PHONE,
            $this->model::ATTR_COUNTRY,
            $this->model::ATTR_STATE
        ];

        $firstName = $this->model::ATTR_CONTACT_FIRST_NAME;
        $lastName = $this->model::ATTR_CONTACT_LAST_NAME;
        $firstAddress = $this->model::ATTR_ADDRESS_FIRST;
        $lastAddress = $this->model::ATTR_ADDRESS_LAST;

        $select = [
            $this->model::ATTR_KEY,
            $this->model::ATTR_CUSTOMER_NAME,
            DB::raw('CONCAT('.$firstName.','.$lastName.') AS contactName'),
            DB::raw('CONCAT('.$firstAddress.','.$lastAddress.') AS address'),
            $this->model::ATTR_CITY,
            $this->model::ATTR_POSTAL_CODE,
            $this->model::ATTR_PHONE,
            $this->model::ATTR_COUNTRY,
            $this->model::ATTR_STATE
        ];

        $customers = $this->model->where(function($q) use ($limit,$start,$search,$order,$dir,$searchable){
            if ($search != '') {
                foreach ($searchable as $field) {
                  $q->orWhere($field,'like',"%{$search}%");
                }
            }
        })
        ->orderBy($searchable[$order],$dir)
        ->get($select);
        
        $data = ['total' => count($customers),'filtered' =>$customers->slice($start,$limit)];

        return $data;
    }
}

<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Customer.
 *
 * @package namespace App\Entities;
 */
class Customer extends Model implements Transformable
{
    use TransformableTrait;

    const ATTR_KEY = 'customerNumber';
    const ATTR_CUSTOMER_NAME = 'customerName';
    const ATTR_CONTACT_FIRST_NAME = 'contactFirstName';
    const ATTR_CONTACT_LAST_NAME = 'contactLastName';
    const ATTR_ADDRESS_FIRST = 'addressLine1';
    const ATTR_ADDRESS_LAST = 'addressLine2';
    const ATTR_CITY = 'city';
    const ATTR_STATE = 'state';
    const ATTR_POSTAL_CODE = 'postalCode';
    const ATTR_COUNTRY = 'country';
    const ATTR_PHONE = 'phone';
    const ATTR_CREDIT_LIMIT = 'creditLimit';

    protected $fillable = [self::ATTR_CUSTOMER_NAME,self::ATTR_CONTACT_FIRST_NAME,self::ATTR_CONTACT_LAST_NAME,self::ATTR_ADDRESS_FIRST,self::ATTR_ADDRESS_LAST,self::ATTR_CITY,self::ATTR_POSTAL_CODE,self::ATTR_COUNTRY,self::ATTR_CREDIT_LIMIT,self::ATTR_STATE];

    public function orders()
    {
    	return $this->hasMany('App\Entities\Order', self::ATTR_KEY);
    }

    public function customerName()
    {
    	return $this->{self::ATTR_CUSTOMER_NAME};
    }

    public function getKey()
    {
        return $this->{self::ATTR_KEY};
    }

    public function contactFullName()
    {
    	return $this->{self::ATTR_CONTACT_FIRST_NAME} . ' ' .$this->{self::ATTR_CONTACT_LAST_NAME};
    }

    public function contactFirstName(){
        return $this->{self::ATTR_CONTACT_FIRST_NAME};
    }
    public function contactLastName()
    {
        return $this->{self::ATTR_CONTACT_LAST_NAME};
    }

    public function address()
    {
    	return $this->{self::ATTR_ADDRESS_FIRST} . ' ' . $this->{self::ATTR_ADDRESS_LAST};
    }

    public function address1()
    {
        return $this->{self::ATTR_ADDRESS_FIRST};
    }
    
    public function address2()
    {
        return $this->{self::ATTR_ADDRESS_LAST};
    }

    public function city()
    {
    	return $this->{self::ATTR_CITY};
    }

    public function state()
    {
        return $this->{self::ATTR_STATE};
    }

    public function postalCode()
    {
    	return $this->{self::ATTR_POSTAL_CODE};
    }

    public function country()
    {
    	return $this->{self::ATTR_COUNTRY};
    }

    public function phone()
    {
        return $this->{self::ATTR_PHONE};
    } 

    public function creditLimit()
    {
        return $this->{self::ATTR_CREDIT_LIMIT};
    }



}

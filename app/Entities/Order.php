<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Order.
 *
 * @package namespace App\Entities;
 */
class Order extends Model implements Transformable
{
    use TransformableTrait;

    const ATTR_KEY = 'orderNumber';
    const ATTR_CUSTOMER_NUMBER = 'customerNumber';
    const ATTR_ORDER_DATE = 'orderDate';
    const ATTR_SHIPPED_DATE = 'shippedDate';
    const ATTR_REQUIRED_DATE = 'requiredDate';
    const ATTR_STATUS = 'status';
    const ATTR_QTY = 'quantity';
    const ATTR_COMMENT = 'comments';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [self::ATTR_KEY,self::ATTR_CUSTOMER_NUMBER,self::ATTR_ORDER_DATE,self::ATTR_SHIPPED_DATE,self::ATTR_REQUIRED_DATE,self::ATTR_STATUS,self::ATTR_QTY,self::ATTR_COMMENT];

    public function customerNumber()
    {
    	return $this->{self::ATTR_CUSTOMER_NUMBER};
    }

    public function getKey()
    {
        return $this->{self::ATTR_KEY};
    }

    public function orderDate()
    {
    	return $this->{self::ATTR_ORDER_DATE};
    }

    public function shippedDate()
    {
    	return $this->{self::ATTR_SHIPPED_DATE};
    }

    public function requiredDate()
    {
        return $this->{self::ATTR_REQUIRED_DATE};
    }

    public function getStatus()
    {
    	return $this->{self::ATTR_STATUS};
    }

    public function comment()
    {
    	return $this->{self::ATTR_COMMENT};
    }

    public function details()
    {
        return $this->hasMany('App\Entities\OrderDetail','orderNumber','orderNumber');
    }

    public function customer()
    {
        return $this->belongsTo('App\Entities\Customer','customerNumber','customerNumber');
    }

}

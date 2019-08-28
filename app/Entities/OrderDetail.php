<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class OrderDetail.
 *
 * @package namespace App\Entities;
 */
class OrderDetail extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'orderdetails';

    const ATTR_ORDER_NUMBER = 'orderNumber';
    const ATTR_PRODUCT_CODE = 'productCode';
    const ATTR_QUANTITY_ORDERED = 'quantityOrdered';
    const ATTR_PRICE_EACH = 'priceEach';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [self::ATTR_ORDER_NUMBER,self::ATTR_PRODUCT_CODE,self::ATTR_QUANTITY_ORDERED,self::ATTR_PRICE_EACH];

    public function orderNumber()
    {
    	return $this->{self::ATTR_ORDER_NUMBER};
    }

    public function productCode()
    {
        return $this->{self::ATTR_PRODUCT_CODE};
    }

    public function quantityOrdered()
    {
    	return $this->{self::ATTR_QUANTITY_ORDERED};
    }

    public function priceEach()
    {
    	return $this->{self::ATTR_PRICE_EACH};
    }

    public function product(){
        return $this->belongsTo('App\Entities\Product','productCode','productCode');
    }

    public function order(){
        return $this->belongsTo('App\Entities\Order','orderNumber','orderNumber');
    }
}

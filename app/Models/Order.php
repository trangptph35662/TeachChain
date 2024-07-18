<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const STATUS_ORDER = [
        'pending' => 'chờ xác nhận',
        'confirmed'=> 'đã xác nhận',
        'preparing_goods'=> 'đang chuẩn bị hàng',
        'shipping'=> 'đang vận chuyển',
        'delivered'=> 'đã giao hàng',
        'canceled'=> 'đơn hàng đã huỷ',
    ] ;
    const STATUS_ORDER_PAYMENT = [
        'uppaid' => 'chờ thanh toán',
        'paid'=> 'đã thanh toán',
        
    ] ;

    const STATUS_ORDER_PENDING = 'pending' ;
    const STATUS_ORDER_CONFIRMED = 'confirmed' ;
    const STATUS_ORDER_PREPARING_GOODS = 'preparing_goods' ;
    const STATUS_ORDER_SHIPPING = 'shipping' ;
    const STATUS_ORDER_DELIVERED = 'delivered' ;
    const STATUS_ORDER_CANCELED = 'canceled' ;
    const STATUS_ORDER_PAYMENT_UPPAID = 'chờ thanh toán' ;
    const STATUS_ORDER_PAYMENT_PAID = 'đã thanh toán' ;
}

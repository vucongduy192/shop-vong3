<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Credit;
use App\Paypal;

class Payment extends Model
{
    protected $table = 'payments';
    protected $fillable = ['amount', 'type', 'order_id'];
    
    const DELIVERED = 1, // Thanh toán khi nhận hàng
          CREDIT = 2,    // Thẻ Visa, Master card
          PAYPAL = 3;    // Paypal

    public static function rule(){
        return array(
            self::DELIVERED => [],
            self::CREDIT => Credit::$rule,
            self::PAYPAL => Paypal::$rule,
        );
    }

    public static function message() {
        return array(
            self::DELIVERED => [],
            self::CREDIT => Credit::$message,
            self::PAYPAL => Paypal::$message,
        );
    }
}


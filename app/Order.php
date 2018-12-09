<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\OrderItem;

class Order extends Model
{
  protected $table = 'orders';
  protected $fillable = ['address', 'email', 'name', 'phone', 'subtotal', 'tax', 'total', '_token'];
  const   ORDER_COMPLETED = 1,  // Order đã tạo nhưng chưa có thông tin payment
    PAYMENT_COMPLETED = 2,  // Hoản thành payment cho order
    SHIPPING = 3,          // Hàng được chuyển đi
    SUCCESS = 4,         // Chuyển hàng thanh công
    DELETE = -1;

  public static $rule = [
    'name' => 'required',
    'address' => 'required',
    'email' => 'required|email',
    'phone' => 'required|numeric',
    'total' => 'required|numeric|min:1'
  ];
  public static $message = [
    'name.required' => 'Hãy nhập tên người dùng',
    'address.required' => 'Hãy nhập thông tin địa chỉ',
    'email.required' => 'Hãy nhập thông tin email',
    'email.email' => 'Email không đúng định dạng',
    'phone.required' => 'Hãy nhập thông tin số điện thoại',
    'phone.numeric' => 'Số điện thoại chỉ bao gồm chữ số',
    'total.required' => 'Không có sản phẩm nào trong giỏ hàng',
    'total.min' => 'Không có sản phẩm nào trong giỏ hàng'
  ];

  public function items()
  {
    return $this->hasMany(OrderItem::class, 'order_id', 'id');
  }

  public function user() {
    return $this->belongsToMany(User::class);
  }
}


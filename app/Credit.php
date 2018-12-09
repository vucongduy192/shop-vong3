<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    protected $table = 'credits';
    protected $fillable = ['name', 'cvv', 'card_number', 'dateOfExpiry', 'payment_id'];
    
    public static $rule = [
    	'name' => 'required',
    	'cvv' => 'required|numeric|digits:3',
    	'card_number' => 'required|numeric|digits:16',
    	'dateOfExpiry' => 'required'
    ];
    public static $message = [
		'name.required' => 'Hãy nhập tên thẻ',
		'cvv.required' => 'Hãy nhập thông tin cvv',
		'cvv.numeric' => 'Cvv chỉ bao gổm chữ số',
		'cvv.digits' => 'Hãy nhập cvv có độ dài bằng 3',
		'card_number.required' => 'Hãy nhập mã số thẻ',
		'card_number.numeric' => 'Mã số thẻ chỉ bao gồm chữ số',
		'card_number.digits' => 'Hãy nhập mã số thẻ có độ dài bằng 16',
		'dateOfExpiry.required' => 'Hãy nhập ngày hết hạn thẻ'
	];


}


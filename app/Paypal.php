<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Paypal extends Model
{
    protected $table = 'paypals';
    protected $fillable = ['email', 'password', 'payment_id'];
    
    public static $rule = [
    	'email' => 'required|email',
    	'password' => 'required' 
    ];
    public static $message = [
    	'email.required' => 'Hãy nhập thông tin paypal email',
    	'email.email' => 'Paypal email không đúng định dạng',
    	'password.required' => 'Hãy nhập thông tin paypal password'
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function($paypal){
             $paypal->password = Hash::make($paypal->password);      
        });
    }
}


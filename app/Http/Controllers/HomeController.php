<?php

namespace App\Http\Controllers;

use App\Lib\Cart\Cart;
use Illuminate\Http\Request;

class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $total_quantity = Cart::totalQuantity();
    return view('front-end.app_default', ['total_quantity' => $total_quantity]);
  }
}

<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Lib\Cart\Cart;
use App\Payment;
use App\Product;
use App\Credit;
use App\Paypal;
use App\Order;
use Config;

class PaymentController extends Controller {

    /**
     * Người dùng bỏ dở bước thanh toán, quay lại vào lấn sau bằng Url gắn trong mail nhận được
     * Trong mail cũng đính kèm link đến chi tiết đơn hàng
     * @param $order_id
     * @param $_token   token được gắn vào urk khi gửi mail cho người dùng
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function store($order_id, $_token, Request $request)
    {
        /*Payment completed before*/
    	$order = Order::where(['id' => $order_id, '_token' => $_token])->first();
        if (empty($order)) 
            return redirect()->back();
        if ($order->status >= 2) {
            return redirect(route('order.view', ['id' => $order_id, '_token' => $_token]));
        }

        /*Save payment to database*/
    	if ($request->isMethod('post')) { 
            $this->validate($request, Payment::rule()[$request->type], Payment::message()[$request->type]);
            
            $payment = Payment::create($request->except('_token'));
            if ($request->type == Payment::CREDIT)
                Credit::create($request->all() + ['payment_id' => $payment->id]);
            if ($request->type == Payment::PAYPAL)
                Paypal::create($request->all() + ['payment_id' => $payment->id]);

            Order::where('id', $order_id)
                ->update(['status' => Order::PAYMENT_COMPLETED]);

    	    return redirect(route('order.view', [ 'id' => $order_id, '_token' => $_token]));
        }
        /* Form payment information */
        return view('front-end.payment', [
        	'order' => $order
        ]);
    }
}

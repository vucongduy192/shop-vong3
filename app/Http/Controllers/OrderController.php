<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderUpdateRequest;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Lib\Cart\Cart;
use App\OrderItem;
use App\Order;
use Config;
use Mail;
use Auth;

class OrderController extends Controller
{
    /* ----------------Trang người dùng------------------*/
    /**
     * Order được tạo mới mặc định status = 1 (chưa thanh toán) => redirect tới trang thanh toán
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, Order::$rule, Order::$message);
        $order = Order::create($request->all());
        /*Save list item in order to db*/
        foreach (Cart::content() as $key => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->getId(),
                'quantity' => $item->getQty(),
                'price' => $item->getPrice(),
                'size' => $item->getOptions()['size'],
            ]);
        }
        Mail::send(['html' => 'front-end.mail-order'], ['order' => $order, 'order_items' => Cart::content()], function (
            $message
        ) use ($order) {
            $message->to($order->email, 'Wear-shop-G8')->subject('Order success');
        });
        Cart::clear();

        return redirect(route('order.payment', [
            'order_id' => $order->id,
            '_token' => $order->_token,
        ]));
    }

    /**
     *
     * @param $order_id
     * @param $_token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function view($order_id, $_token)
    {
        $order = Order::where(['id' => $order_id, '_token' => $_token])->first();
        if (empty($order)) {
            return redirect()->back();
        }

        return view('front-end.order-view', [
            'order' => $order,
        ]);
    }

    /**
     * Chỉ cho phép xóa những đơn hàng chưa ship
     *
     * @param $id order_id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete($id)
    {
        $var = OrderItem::where('order_id', '=', $id)->get();
        $num = $var->count();
        for ($i = 0; $i < $num; $i++) {
            OrderItem::where('order_id', '=', $id)->delete();
        }
        Order::find($id)->delete();

        //echo"Xóa thành công!";
        return redirect(route('order.history'));
    }

    /**
     * Lấy lịch sử đơn hàng dựa vào email mà người dùng đăng ký
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function history()
    {
        $email = Auth::user()->email;
        $orders = Order::where(['email' => $email])->get();

        return view('front-end.order-history', compact('orders'));
    }

    /* ----------------- Trang admin --------------------*/
    /**
     * @return mixed
     * @throws \Exception
     */
    public function getOrdersDatatables()
    {
        $orders = Order::all();

        return DataTables::of($orders)->addColumn('action', function ($order) {
            return "<a class='btn btn-sm btn-info' href='/admin/orders/$order->id'>View</a>"."<button class='btn btn-sm btn-danger' data-toggle='modal' data-target='#delete-order' onclick='deleteOrder($order->id)'>Delete</button>";
        })->make(true);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getOrderView()
    {
        $pending = Order::where('status', '=', Order::ORDER_COMPLETED)->count();
        $payment = Order::where('status', '=', Order::PAYMENT_COMPLETED)->count();
        $shipping = Order::where('status', '=', Order::SHIPPING)->count();
        $complete = Order::where('status', '=', Order::SUCCESS)->count();

        return view('admin.orders', compact('pending', 'payment', 'shipping', 'complete'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getOrderDetailView(Request $request)
    {
        $id = $request->id;
        $order = Order::find($id);

        return view('admin.order-detail', compact('order', 'id'));
    }

    /**
     * @param $id order_id
     * @return $this
     */
    public function destroy($id)
    {
        Order::destroy($id);

        $pending = Order::where('status', '=', Order::ORDER_COMPLETED)->count();
        $payment = Order::where('status', '=', Order::PAYMENT_COMPLETED)->count();
        $shipping = Order::where('status', '=', Order::SHIPPING)->count();
        $complete = Order::where('status', '=', Order::SUCCESS)->count();

        return view('admin.orders', compact('pending', 'payment', 'shipping', 'complete'))->with('success', 'Delete success');
    }

    /**
     * @param $id   order_id
     * @return mixed
     */
    public function getOrderItemsDatatables($id)
    {
        $order = Order::find($id);
        $orderItems = $order->items()->with('product')->get();

        return DataTables::of($orderItems)->make();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function setStatusOrder(Request $request)
    {
        $id = $request->id;
        $order = Order::find($id);

        $order->status = $request->status;
        $order->save();

        return view('admin.order-detail', compact('order', 'id'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getOrderApi($id)
    {
        $order = Order::find($id);

        return response()->json([
            'data' => $order,
        ]);
    }
}

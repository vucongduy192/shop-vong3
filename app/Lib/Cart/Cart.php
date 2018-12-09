<?php 

namespace App\Lib\Cart;
use Illuminate\Support\Facades\Session; 
use App\Lib\Cart\Item;

class Cart
{
	CONST SESSION_NAME = 'cart';	// name save in session

    /**
     * @param int    $id
     * @param string $name
     * @param int    $qty
     * @param int    $price
     * @param array  $options
     * @return \App\Lib\Cart\Item
     */
	public static function add($id = NULL, $name = NULL, $qty = NULL, $price = NULL, $options = array()) {
		$item = new Item($id, $name, $qty, $price, $options);
		$cartItems = self::content();

		if (!empty($exist = self::find($item->getRowId()))) {
			$item->setQty($qty + $exist->getQty());
		}

		$cartItems[$item->getRowId()] = $item;
		Session::put(self::SESSION_NAME, $cartItems);
		return $item;
	}

    /**
     * @param  string  $rowId
     * @return array \App\Lib\Cart\Item |null
     */
	public static function find($rowId) {
		$cartItems = self::content();
		$item = isset($cartItems[$rowId])
			? $cartItems[$rowId]
			: NULL;
		return $item;
	}

    /**
     * @param string    $rowId
     */
	public static function remove($rowId) {
		$cartItems = self::content();
		unset($cartItems[$rowId]);
		Session::put(self::SESSION_NAME, $cartItems);	
	}

	/**
	 * clear cart in session
	 * @return
	 */
	public static function clear()
	{
		Session::forget(self::SESSION_NAME);
	}

    /**
     * @return array \App\Lib\Cart\Item |null
     */
	public static function content()
	{
		$content = Session::has(self::SESSION_NAME)
            ? Session::get(self::SESSION_NAME)
            : [];
        return $content;
	}

    /**
     * @param string    $rowId
     * @param int       $qty
     */
	public static function update($rowId, $qty = NULL)
	{
		$cartItems = self::content();
		if (!empty($qty))
			$cartItems[$rowId]->setQty($qty);
		Session::put(self::SESSION_NAME, $cartItems);
	}

    /**
     * @return int
     */
	public static function subTotal()
	{
		$cartItems = self::content();
		$total = 0;
		foreach ($cartItems as $key => $item) {
			$total += $item->getQty() * $item->getPrice();
		}
        return $total;
	}

    /**
     * Pass tax or use defaul tax = 10%
     * @param  int $tax
     * @return float|int
     */
	public static function total($tax = 10)
	{
        return self::subTotal() * (100+$tax)/100;
	}

    /**
     * @return int
     */
	public static function totalQuantity()
	{
		$cartItems = self::content();
		$total_quantity = 0;
		foreach ($cartItems as $key => $item) {
			$total_quantity += $item->getQty();
		}
        return $total_quantity;	
	}
}
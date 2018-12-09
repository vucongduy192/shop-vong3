<?php
namespace App\Lib\Product\Filter;

class NameFilter implements FilterInterface{
	private $name;

    /**
     * NameFilter constructor.
     * @param String    $name
     */
	function __construct($name)
	{
		$this->name = strtolower($name);
	}

    /**
     * Filter product by name
     * @param   array App\Product   $all_products
     * @return  array App\Product
     */
	public function execute($all_products)
	{	
		$filter_products = array();
		foreach ($all_products as $key => $product) {	
			if (strpos(strtolower($product->name), $this->name) !== false)
				array_push($filter_products, $product);
		}
		return $filter_products;
	}
}
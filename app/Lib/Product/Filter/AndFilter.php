<?php
namespace App\Lib\Product\Filter;

class AndFilter implements FilterInterface{
	private $filters;

    /**
     * AndFilter constructor.
     * @param array App\Lib\Product\Filter\FilterInterface  $filters
     */
	function __construct($filters = array())
	{
		$this->filters = $filters;
	}

    /**
     * @param  array App\Product $all_products
     * @return array App\Product
     */
	public function execute($all_products)
	{
		$filter_products = $all_products;
		foreach ($this->filters as $key => $filter) {
			$filter_products = $filter->execute($filter_products);
		}
		return $filter_products;
	}
}
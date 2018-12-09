<?php 
namespace App\Lib\Product\Filter;

interface FilterInterface {
	
    /**
     * @param  array App\Product     $all_products
     * @return array App\Product
     */
	public function execute($all_products);
}
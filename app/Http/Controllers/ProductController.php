<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\ProductUpdateRequest;
use Config;
use View;
use Validator;
use Illuminate\Http\Request;
use App\Product;
use Yajra\DataTables\DataTables;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Lib\Product\Filter\PriceFilter;
use App\Lib\Product\Filter\NameFilter;
use App\Lib\Product\Filter\CategoryFilter;
use App\Lib\Product\Filter\AndFilter;
use App\Lib\Cart\Cart;

class ProductController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //dd(file_exists('http://shop.local//images/products/1542525213aothunnam1.png'));
        $config = Config::get('config');

        return view('front-end.product', [
            'categories' => $config['categories'],
            'prices' => $config['prices']
        ]);
    }

    /**
     * @param  int $id product of id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail($id)
    {
        $product = Product::where('id', $id)->first();

        return view('front-end.product-detail', [
            'product' => $product
        ]);
    }

    /**
     * Áp dùng 
     * @param  Request $request : criteria to filter product {$keyword, $categpry_id, $price_start}
     * @return array    html to render [HTML, Paginate Link]
     */
    public function filter(Request $request)
    {
        // Implement filter type
        $arr_filter = [];
        if (isset($request->keyword)) {
            array_push($arr_filter, new NameFilter($request->keyword));
        }
        if (isset($request->category_id)) {
            array_push($arr_filter, new CategoryFilter($request->category_id));
        }
        if (isset($request->price_start)) {
            array_push($arr_filter, new PriceFilter($request->price_start, $request->price_end));
        }
        $and_filter = new AndFilter($arr_filter);

        // Execute filter
        $all_products = Product::orderBy('price', 'desc')->get();
        $filter_products = $and_filter->execute($all_products);

        // Render to Html
        $paginatedItems = $this->array_paginate($request, $filter_products);

        return [
            'html' => View::make('front-end.product-list')->with(['products' => $paginatedItems])->render(),
            'pages' => View::make('front-end.pagination')->with(['paginator' => $paginatedItems])->render(),
        ];
    }

    /**
     * @param Request $request : set Url pagination
     * @param array App\product $filter_products : array
     * @return LengthAwarePaginator
     */
    public function array_paginate($request, $filter_products)
    {
        // Laravel pagination support
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $itemCollection = collect($filter_products);
        $perPage = 6;
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
        $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
        $paginatedItems->setPath($request->url());

        return $paginatedItems;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View admin.product
     */
    public function getProductManagerPage()
    {
        return view('admin.products');
    }

    /**
     * @return Yajra\DataTables\DataTables productDatatables
     */
    public function getProductsDatatables()
    {
        $products = Product::select([
            'id',
            'category_id',
            'name',
            'description',
            'price',
            'quantity',
            'img1',
            'img2',
            'img3',
        ]);

        return Datatables::of($products)->addColumn('action', function ($product) {

                return "<button type='button' class='btn btn-sm btn-danger' data-toggle='modal' data-target='#delete-alert' onclick='deleteProduct($product->id)'>Delete</button>"."<button type='button' class='btn btn-sm btn-warning' data-toggle='modal' data-target='#productDetail' onclick='productDetail($product->id)'>Edit</button>"."<button type='button' class='btn btn-sm btn-primary'><a href='/admin/products/$product->id' class='text-white'>View</a></button>";
            })->make(true);
    }

    /**
     * @param ProductUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse admin.product
     */
    public function editProduct(ProductUpdateRequest $request)
    {
        $request->validated();

        $product = Product::find($request->id);
        $requestData = $request->all();
        $requestData['img1'] = Product::createImage($request->img1, $product->img1);
        $requestData['img2'] = Product::createImage($request->img2, $product->img2);
        $requestData['img3'] = Product::createImage($request->img3, $product->img3);

        $product->update($requestData);

        return redirect(route('productsManager'))->with('update_success', $request->name);
    }

    /**
     * @param CreateProductRequest $request
     * @return \Illuminate\Http\RedirectResponse admin.product
     */
    public function createProduct(CreateProductRequest $request)
    {
        $requestData = $request->all();
        $requestData['img1'] = Product::createImage($request->img1);
        $requestData['img2'] = Product::createImage($request->img2);
        $requestData['img3'] = Product::createImage($request->img3);
        Product::create($requestData);

        return redirect(route('productsManager'))->with('created_success', $request->name);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector admin.product
     */
    public function deleteManager($id)
    {
        Product::destroy($id);

        return redirect(route('productsManager'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View admin.product
     */
    public function productDetail(Request $request)
    {
        $id = $request->id;

        $product = Product::find($id);

        return view('admin.product-detail', ['product' => $product]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse $product
     */
    public function getProductAPI(Request $request)
    {
        $product = Product::find($request->id);

        return response()->json([
            'data' => $product,
        ]);
    }
}


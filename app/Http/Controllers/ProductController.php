<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = Product::with('category', 'product_colors', 'product_colors.product_details', 'product_images')->get();
        return response()->json($products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //tim kiem san pham theo id
        $productIds = explode('.', $id);
        $products = Product::with('category', 'product_colors', 'product_colors.product_details', 'product_images')->whereIn('id', $productIds)->get();
        return response()->json($products);
    }

    // public function search(Request $request)
    // {
    //     $keyword = $request->input('keyword');

    //     $products = Product::with('category', 'product_colors', 'product_colors.product_details', 'product_images')
    //         ->where('name', 'like', '%' . $keyword . '%')
    //         ->get();
    //     return response()->json($products);
    // }
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $products = Product::with('category', 'product_colors', 'product_colors.product_details', 'product_images')
            ->where('name', 'like', '%' . $keyword . '%')
            ->paginate(2);
        return $products;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Product  $product
     * @return \Illuminate\Http\Response
     */
    public function categoryID($categoryId)
    {
        // $categoryId = $request->input('category_id');

        // Tìm kiếm sản phẩm dựa trên category_id
        $products = Product::with('category', 'product_colors', 'product_colors.product_details', 'product_images')->where('category_id', $categoryId)->get();

        // Trả về kết quả dưới dạng ProductResource collection
        return response()->json($products);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
// List of all products
    public function productList()
    {
        $products = Product::get()->toJson(JSON_PRETTY_PRINT);
        return response($products, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
// Create a new product
    public function storeProduct(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'price' => 'required'
        ]);

        $products = Product::create($request->all())->toJson(JSON_PRETTY_PRINT);
        return response($products,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
// Update product
    public function updateProduct(Request $request, $id)
    {
        $product = Product::find($id);
        $product->update($request->all());
        return $product;
    }
}

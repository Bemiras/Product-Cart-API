<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use http\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $fields = $request->validate([
            'idProduct' => 'required'
        ]);

        $idUser = auth('sanctum')->user()->id;
        $idProduct = $fields['idProduct'];

        $quantity = DB::table('carts')
            ->where('idCart',$idUser and  'idProduct',$idProduct)
            ->count('idProduct');

        return Cart::create([
            'idCart' => $idUser,
            'idProduct' => $fields['idProduct'],
            'quantity' => $quantity+1
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $idCart
     * @return \Illuminate\Http\Response
     */
    public function show($idCart)
    {
        $totalPrice['totalPrice'] = DB::table('carts')
                      ->join('products', 'carts.idProduct', '=', 'products.id')
                      ->where('idCart',$idCart)
                      ->sum('products.price');


        $productsList['product'] = DB::table('carts')
                        ->join('products', 'carts.idProduct', '=', 'products.id')
                        ->where('idCart',$idCart)
                        ->select('products.title','products.price','products.quantity')
                        ->get();

        return [$productsList, $totalPrice];
    }
}

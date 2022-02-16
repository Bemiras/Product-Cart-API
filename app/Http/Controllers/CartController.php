<?php

namespace App\Http\Controllers;

use App\Models\Cart;
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
    public function storeCart(Request $request)
    {
       $fields = $request->validate([
            'idProduct' => 'required'
        ]);

// ID logged user
        $idUser = auth('sanctum')->user()->id;
        $idProduct = $fields['idProduct'];

// Get product price
        $total = DB::table('products')
            ->where( 'id',$idProduct)
            ->select('price')
            ->first();

// Get a product quantity
        $quantity = DB::table('carts')
            ->where('idCart',$idUser)
            ->where( 'idProduct',$idProduct)
            ->select('quantity')
            ->first();

// Checking if the user's product already in the cart
        $newProduct = DB::table('carts')
            ->where('idCart',$idUser)
            ->where( 'idProduct',$idProduct)
            ->count();

// Find cart.id if user's product is in the cart
        $id = DB::table('carts')
            ->where('idCart',$idUser)
            ->where( 'idProduct',$idProduct)
            ->select('id')
            ->first();

// If user's product is a new in the cart
        if($newProduct == 0){
            $cart = Cart::create([
                'idCart' => $idUser,
                'idProduct' => $idProduct,
                'quantity' => 1,
                'total' => $total->price
            ])->toJson(JSON_PRETTY_PRINT);
        }
// If user already added product to his cart, update quantity and total
        else {
            $quantity->quantity = $quantity->quantity + 1;
            $total = $total->price * $quantity->quantity;
            $cart = Cart::find($id->id);
            $cart->update([
                'quantity' => $quantity->quantity,
                'total' => $total
            ]);
        }

        return response($cart,200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $idUser
     * @return \Illuminate\Http\Response
     */
    public function showCart($idUser)
    {
// List of product
        $productsList['products'] = DB::table('carts')
                                    ->join('products', 'carts.idProduct', '=', 'products.id')
                                    ->where('idCart',$idUser)
                                    ->select('products.title','products.price','carts.quantity','carts.total')
                                     ->get();

// Addition price all products in the users cart
        $totalPrice['totalPrice'] = DB::table('carts')
                                    ->join('products', 'carts.idProduct', '=', 'products.id')
                                    ->where('idCart',$idUser)
                                    ->sum('carts.total');

        return response([$productsList, $totalPrice],200);
    }
}

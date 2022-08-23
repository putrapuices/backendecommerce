<?php

namespace App\Http\Controllers\Api\Web;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;

class CartController extends Controller
{
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api_customer');
    } 

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carts = Cart::with('product')
                ->where('customer_id', auth()->guard('api_customer')->user()->id)
                ->latest()
                ->get();
        
        //return with Api Resource
        return new CartResource(true, 'List Data Carts : '.auth()->guard('api_customer')->user()->name.'', $carts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = Cart::where('product_id', $request->product_id)->where('customer_id', auth()->guard('api_customer')->user()->id);

        //check if product already in cart and increment qty
        if ($item->count()) {

            //increment / update quantity
            $item->increment('qty');

            $item = $item->first();

            //sum price * quantity
            $price = $request->price * $item->qty;

            //sum weight
            $weight = $request->weight * $item->qty;

            $item->update([
                'price'     => $price,
                'weight'    => $weight
            ]);

        } else {

            //insert new item cart
            $item = Cart::create([
                'product_id'    => $request->product_id,
                'customer_id'   => auth()->guard('api_customer')->user()->id,
                'qty'           => $request->qty,
                'price'         => $request->price,
                'weight'        => $request->weight
            ]);

        }
     
        //return with Api Resource
        return new CartResource(true, 'Success Add To Cart', $item);
        
    }
    
    /**
     * getCartPrice
     *
     * @return void
     */
    public function getCartPrice()
    {
        $totalPrice = Cart::with('product')
            ->where('customer_id', auth()->guard('api_customer')->user()->id)
            ->sum('price');
        
        //return with Api Resource
        return new CartResource(true, 'Total Cart Price', $totalPrice);
    }
    
    /**
     * getCartWeight
     *
     * @return void
     */
    public function getCartWeight()
    {
        $totalWeight = Cart::with('product')
        ->where('customer_id', auth()->guard('api_customer')->user()->id)
        ->sum('weight');

        //return with Api Resource
        return new CartResource(true, 'Total Cart Weight', $totalWeight);
    }
    
    /**
     * removeCart
     *
     * @param  mixed $request
     * @return void
     */
    public function removeCart(Request $request)
    {
        $cart = Cart::with('product')
            ->whereId($request->cart_id)
            ->first();
            
        $cart->delete();

        //return with Api Resource
        return new CartResource(true, 'Success Remove Item Cart', null);
    }
}
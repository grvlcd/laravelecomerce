<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public $cartService;
    public function __construct(CartService $cartService) {
        $this->cartService = $cartService;
        $this->middleware('auth');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cart = $this->cartService->getFromCookie();
        if(!isset($cart) || $cart->products->isEmpty()) {
            return redirect()->back()->withErrors('Cart is empty.');
        }
        return view('order.create')->with([
            'cart' => $cart
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        return DB::transaction(function () use($request) {
            $user = $request->user();
            $order = $user->orders()->create([
                'status' => 'pending',
            ]);
            $cart = $this->cartService->getFromCookie();
        
            $cartProducts = $cart->products->mapWithKeys(function($product) {
                $quantity = $product->pivot->quantity;
                if($product->stocks < $quantity) {
                    throw ValidationException::withMessages([
                        'cart' => "Not enough stocks for the item {$product->title}",
                    ]);
                }
                $product->decrement('stocks', $quantity);
                $element[$product->id] = ['quantity' => $quantity];            
                return $element;
            });
        
            $order->products()->attach($cartProducts->toArray());
            return redirect()->route('order.payment.create', ['order' => $order->id]);
        }, 5);
    }
}

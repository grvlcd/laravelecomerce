<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Services\CartService;

class CartController extends Controller
{
    public $cartService;
    public function __construct(CartService $cartService) {
        $this->cartService = $cartService;
    }
    
    public function index() {
        $cart = $this->cartService->getFromCookieOrCreate();
        return view('cart.cart')->with(['cart' => $cart]);
    }
}

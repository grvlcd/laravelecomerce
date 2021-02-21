<?php

namespace App\Http\Controllers\Panel;

use App\Models\PanelProduct;
use App\Http\Requests\ProductRequest;
use App\Http\Controllers\Controller;
use App\Scopes\AvailableScope;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $products = PanelProduct::without('images')->get();
        return view('products.ProductList', [
            'products' => $products,
        ]);
    }

    public function store(ProductRequest $request) {
        $product = PanelProduct::create($request->all());
        return redirect()->route('product')
        ->with(['product' => $product])
        ->withSuccess('Product created successfully');
    }

    public function show(PanelProduct $product) {
        return view('products.ProductDetail')
        ->with(['product' => $product]);
    }

    public function update(ProductRequest $request, PanelProduct $product) {
        $product->update($request->all());
        return back()->withSuccess('Product updated successfully');;
    }

    public function destroy(PanelProduct $product) {
        $product->delete();
        return redirect()->route('product')
        ->withSuccess('Product delete successfully');;
    }
}

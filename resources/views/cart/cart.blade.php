@extends('layouts.app')
@section('content')
    @if (!isset($cart) || $cart->products->isEmpty())
        <div class="text-center">
            <h1>No products</h1>
        </div>
    @else
        <a href="{{ route('order.create') }}" class="btn btn-primary m-4" role="button">
            Place order
        </a>
        <div class="container-fluid d-flex flex-row flex-wrap  justify-content-around">
            @foreach ($cart->products as $product)
                @include('components.product-card')
            @endforeach
        </div>
    @endif
@endsection

@extends('layouts.app')
@section('content')
    <form class="d-inline m-2" action="{{ route('order.store') }}" method="post">
        @csrf
        <button class="btn btn-warning m-4" type="submit">Proceed to payment</button>
    </form>
    <div class="container-fluid d-flex flex-row flex-wrap  justify-content-around">

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Item</th>
                    <th scope="col">Description</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cart->products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->title }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->pivot->quantity }}x</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->total }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-right">
            <h1 class="text-right">{{ $cart->total }}</h1>
        </div>
    </div>
@endsection

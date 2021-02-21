@extends('layouts.app')
@section('content')
    @if ($products->isEmpty())
        <div class="text-center">
            <h1>No products</h1>
        </div>
    @else
        <div class="container-fluid d-flex flex-row flex-wrap  justify-content-around">
            @foreach ($products as $product)
                @include('components.product-card')
            @endforeach
        </div>
    @endif
@endsection

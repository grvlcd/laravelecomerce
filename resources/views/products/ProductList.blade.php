@extends('layouts.app')
@section('content')
    <a href="{{ route('product.create.form') }}" class="btn btn-success m-4" role="button">Add Product</a>
    @if ($products->isEmpty())
        <div class="text-center">
            <h1>No products</h1>
        </div>
    @else
        <div class="container-fluid d-flex flex-row flex-wrap  justify-content-around">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Product</th>
                        <th scope="col">Description</th>
                        <th scope="col">Status</th>
                        <th scope="col">Stocks</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td><a href="{{ route('product.detail', $product->id) }}">{{ $product->title }}</a></td>
                            <td>{{ $product->description }}</td>
                            <td class="{{ $product->status == 'available' ? 'text-success' : 'text-danger' }}">
                                {{ $product->status }}
                            </td>
                            <td>{{ $product->stocks }}</td>
                            <td>{{ $product->price }}</td>
                            <td>
                                <a class="btn btn-link" href="{{ route('product.detail', $product->id) }}">Edit</a>
                                <form class="d-inline" action="{{ route('product.destroy', $product->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-danger btn btn-link" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection

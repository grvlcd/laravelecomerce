@extends('layouts.app')
@section('content')
    <div class="container-fluid d-flex flex-row flex-wrap  justify-content-around">
        <form class="d-inline m-2" action="{{ route('order.payment.store', ['order' => $order->id]) }}" method="post">
            <h1>Grand Total: ${{ $order->total }}</h1>
            @csrf
            <button class="btn btn-warning m-4" type="submit">Pay</button>
        </form>
    </div>
@endsection

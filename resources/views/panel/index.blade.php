@extends('layouts.app')
@section('content')
    <div class="container-fluid d-flex flex-row flex-wrap  justify-content-start">
        <div class="list-group">
            <a class="list-group-item" href="{{ route('product') }}">Manage Products</a>
        </div>
    </div>
@endsection

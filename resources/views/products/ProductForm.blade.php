@extends('layouts.app')
@section('content')
    <div class="container-sm">
        <form action="{{ route('product.create') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
            </div>
            <div class=" mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="description" cols="30" rows="10"
                    value="{{ old('description') }}"></textarea>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" min="1.00" step="0.01" class="form-control" id="price" name="price"
                    value="{{ old('price') }}" required>
            </div>
            <div class="mb-3">
                <label for="stocks" class="form-label">Stocks</label>
                <input type="number" min="0" class="form-control" id="stocks" name="stocks" value="{{ old('stocks') }}"
                    required>
            </div>
            <div class="mb-3">
                <select id="status" name="status" class="form-control" aria-label="Status">
                    <option value="available" value="{{ old('status') == 'available' ? 'selected' : '' }}">Available
                    </option>
                    <option value="unavailable" value="{{ old('status') == 'unavailable' ? 'selected' : '' }}">Unavailable
                    </option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection

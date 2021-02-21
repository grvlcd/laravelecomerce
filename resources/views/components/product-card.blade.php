<div class="card mb-4" style="width: 25rem;">
    <div id="carousel{{ $product->id }}" class="carousel slide carousel-fade">
        <div class="carousel-inner">
            @foreach ($product->images as $image)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <img class="d-block card-img-top w-100" height="500" src="{{ asset($image->path) }}">
                </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carousel{{ $product->id }}" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#carousel{{ $product->id }}" role="button" data-slide="next">
            <span class="carousel-control-next-icon"></span>
        </a>
    </div>
    <div class="card-body">
        <h4 class="text-right">${{ $product->price }}</h4>
        <h5>{{ $product->title }}</h5>
        <p>
            <strong>Description:</strong> {{ $product->description }}
        </p>

        <p class="{{ $product->stocks >= 10 ? 'text-success' : 'text-danger' }}">
            <strong class="text-dark">Available stocks:</strong> {{ $product->stocks }}
        </p>

        <p class="{{ $product->status == 'available' ? 'text-success' : 'text-danger' }}">
            {{ $product->status }}
        </p>
    </div>
    @if (isset($cart))
        <nav class="d-flex flex-row align-items-center justify-content-center">
            <ul class="pagination">
                <li class="page-item">
                    <button type="button" class="page-link form-control">-</button>
                </li>
                <li class="page-item">
                    <input type="number" class="form-control text-center" min="1" step="1"
                        value="{{ $product->pivot->quantity }}">
                    <h4 class="text-center">${{ $product->total }}</h4>
                </li>
                <li class="page-item">
                    <button type="button" class="page-link form-control">+</button>
                </li>
            </ul>
        </nav>
        <form class="d-inline"
            action="{{ route('product.cart.destroy', ['product' => $product->id, 'cart' => $cart->id]) }}"
            method="post">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger m-4" type="submit">Remove</button>
        </form>
    @else
        <form class="d-inline" action="{{ route('product.cart.store', $product->id) }}" method="post">
            @csrf
            <button class="btn btn-success m-4" type="submit">Add to Cart</button>
        </form>
    @endif
</div>

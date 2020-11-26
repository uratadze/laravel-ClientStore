@extends('layouts.app')
<style>

</style>
@section('content')
<div class="form-inline">
    @foreach($products as $product)
    <div class="card" style="width: 18rem;margin:10px">
      <div class="col-12 col-sm-12 col-md-2 text-center">
        <img class="img-responsive" src="{{ route('product.picture', $product->id) }}" alt="prewiew" width="255" height="180">
      </div>
      {{-- <img src="{{ route('product.picture', $product->id) }}" class="card-img-top" alt="..." > --}}
      <div class="card-body">
        <h4 class="card-title">{{ $product->name }}</h4>
        <h6 class="card-title"> @lang('კატეგორია: ') {{ $product->getCategory->name }}</h6>
        <h6 class="card-title"> @lang('Stock: ') {{ $product->quantity }}</h6>
        <p class="card-text product-cart-text">{{ $product->description }}</p>
        <form class="form-inline" action="{{ route('shop.cart.add') }}" method="GET">
          <div class="row" style="position: absolute">
            <button class="form btn btn-primary" value="{{ $product->id }}" name="product" >@lang('Add to Cart')</button>
            <input class="form-control" id="ex1" type="number" min="1" value="1" name="quantity" width="120px" height="12px">
          </div>
        </form>
      </div>
    </div>
    @endforeach
</div>
@endsection
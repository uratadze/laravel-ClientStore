@extends('layouts.app')
<title>@lang('Shop Cart')</title>

@section('content')

<script src="https://use.fontawesome.com/c560c025cf.js"></script>
<form action="{{ route('shop.cart.submit') }}" method="POST" nctype="multipart/form-data">
    @csrf
<div class="container">
   <div class="card shopping-cart">
        <div class="card-header bg-dark text-light">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                Shipping cart
                <a href="{{ route('store') }}" class="btn btn-outline-info btn-sm pull-right">Continiu shopping</a>
                <div class="clearfix"></div>
        </div>
        <div class="card-body">
                    <!-- PRODUCT -->
                @foreach ($items as $item)
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-2 text-center">
                                <img class="img-responsive" src="{{ route('product.picture', $item->getProduct->id) }}" alt="prewiew" width="120" height="80">
                        </div>
                        <div class="col-12 text-sm-center col-sm-12 text-md-left col-md-6">
                            <h4 class="product-name"><strong>{{ $item->getProduct->name }}</strong></h4>
                        </div>
                        <div class="col-12 col-sm-12 text-sm-center col-md-4 text-md-right row">
                            <div class="col-3 col-sm-3 col-md-6 text-md-right" style="padding-top: 5px">
                                <h6><strong>{{ $item->getProduct->price }}$ <span class="text-muted">x</span></strong></h6>
                            </div>
                            <div class="col-4 col-sm-4 col-md-4">
                                <div class="quantity">
                                    <input class="form-control" id="ex1" type="number" min="1" value="{{ $item->quantity }}" name="quantity[{{$item->getProduct->id}}]">
                                </div>
                            </div>
                            <div class="col-2 col-sm-2 col-md-2 text-right">
                                <a class="btn btn-outline-danger btn-xs" href="{{ route('shop.cart.remove', $item->id) }}" style="margin-bottom:20px"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                    <hr>
                @endforeach
                    <!-- END PRODUCT -->

                <div class="pull-right">
                    <button class="btn btn-outline-secondary pull-right" name="action" value="update">@lang('Update shopping cart')</button>
                </div>
        </div>
        <div class="card-footer">
                <div class="pull-right" style="margin: 10px">
                    <button class="btn btn-success pull-right" name="action" value="checkout">@lang('Checkout')</button>

                    <div class="pull-right" style="margin: 5px">
                        Total price: <b>{{ (new App\Models\ShopCart)->totalPrice() }}$</b>
                    </div>
                </div>
        </div>
    </div>
</div>
</form>

@endsection
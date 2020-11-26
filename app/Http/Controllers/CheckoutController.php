<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\ShopCart;
use App\Http\Requests\PersonInfoRequest;
use App\Analyzer\CheckoutAlanyzer;

class CheckoutController extends Controller
{
    /**
     * Create a new analyzer instance.
     *
     * @param App\Analyzer\CheckoutAlanyzer
     * @return void
     */
    public function __construct(CheckoutAlanyzer $analyzer)
    {
        $this->analyzer = $analyzer;
    }

    /**
     * Create a new person or Checkout.
     *
     * @param App\Models\Person
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Person $person)
    {
        return $person->personInfoExist() ? $this->analyzer->checkout() : redirect()->route('person.info');
    }

    /**
     * New person create form.
     *
     * @param App\Models\ShopCart
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function personInfo(ShopCart $shopCart)
    {
        return $shopCart->shopCartFill() ? view('checkout.show-person-info-form') : redirect()->route('shop.cart');
    }

    /**
     * Store new person information.
     *
     * @param App\Http\Requests\PersonInfoRequest
     * @param App\Models\ShopCart
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function storePersonInfo(PersonInfoRequest $request, ShopCart $shopCart)
    {
        return $shopCart->shopCartFill() ? $this->analyzer->fillPersonInfo($request) : redirect()->route('shop.cart');
    }

}
